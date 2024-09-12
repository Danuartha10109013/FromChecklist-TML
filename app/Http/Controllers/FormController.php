<?php

namespace App\Http\Controllers;

use App\Models\FormField;
use App\Models\FormsModel;
use App\Models\KateFormsModel;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index(){
        // Mengambil semua data Forms
        $data = FormsModel::all();
    
        // Mengambil semua kategori yang terkait dengan forms
        $kategori = [];
        foreach ($data as $d) {
            $kategori[$d->id] = KateFormsModel::where('id', $d->kategori)->value('kategori');
        }
    
        return view('admin.form.index', compact('data', 'kategori'));
    }
    
    public function create(){
        $categories = KateFormsModel::all();
        return view('admin.form.create',compact('categories'));
    }

    public function store(Request $request)
{
    // dd($request->all());

    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'kategori' => 'required|exists:kategoriforms,id',
        'active' => 'required|boolean',
    ]);


    // Membuat form baru
    $form = new FormsModel();
    $form->nama = $request->input('nama');
    $form->kategori = $request->input('kategori');
    $form->active = $request->input('active');
    $form->save();

    $formfield = new FormField;
    $formfield->id_forms = $form->id;
    $formfield->save();

    
    // Redirect dengan pesan sukses
    return redirect()->route('admin.form')->with('success', 'Form berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Cari data form berdasarkan ID
        $form = FormsModel::findOrFail($id);
    
        // Jika ada tabel kategori terpisah, ambil datanya juga
        $kategori = KateFormsModel::all(); // Ganti 'KateFormsModel' dengan model yang sesuai jika Anda punya tabel kategori
    
        // Tampilkan halaman edit dengan data form yang ditemukan
        return view('admin.form.edit', compact('form', 'kategori'));
    }
    


    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'kategori' => 'required|exists:kategoriforms,id', // Sesuaikan dengan tabel yang Anda gunakan
        'status' => 'required|boolean',
    ]);

    // Cari data form berdasarkan ID
    $form = FormsModel::findOrFail($id);

    // Update data form
    $form->nama = $request->input('nama');
    $form->kategori = $request->input('kategori');
    $form->active = $request->input('status');
    $form->save();

    // Redirect dengan pesan sukses
    return redirect()->route('admin.form')->with('success', 'Form berhasil diperbarui.');
}



    public function show($id){
        $data = FormsModel::where('id', $id)->get();
        $form = FormField::where('id_forms',$id)->get();
        $formFields = FormField::where('id_forms', $id)->get();

        // dd($id,$form);
        return view('admin.form.shows',compact('data','form','formFields'));
    }

    public function active($id) {
        // Temukan data berdasarkan ID
        $data = FormsModel::find($id);
    
        // Pastikan data ditemukan
        if ($data) {
            // Ubah nilai active menjadi 1
            $data->active = 1;
            
            // Simpan perubahan
            $data->update();
        }
        return redirect()->back()->with('success','Form berhasil diaktifkan');

    }
    public function inactive($id) {
        // Temukan data berdasarkan ID
        $data = FormsModel::find($id);
    
        // Pastikan data ditemukan
        if ($data) {
            // Ubah nilai active menjadi 1
            $data->active = 2;
            
            // Simpan perubahan
            $data->update();
        }
        return redirect()->back()->with('error','Form berhasil dinonaktifkan');
    }

    public function destroy($id) {
        $data = FormsModel::find($id);
    
        if ($data) {
            $data->delete();
            return redirect()->route('admin.form')->with('success', 'Form berhasil dihapus.');
        } else {
            return redirect()->route('admin.form')->with('error', 'Form tidak ditemukan.');
        }
    }
    
    public function showForm()
{
    $fields = FormField::all(); // Ambil semua field dari database
    
    return view('forms.index', compact('fields'));
}

    public function add_form($id){
        $data = FormsModel::where('id',$id)->value('id');
        return view('forms.index',compact('data'));
    }
    public function saveForm(Request $request,$id)
{
    // Validate the request data
    // dd($id);

    // dd($request->all());
    $request->validate([
        'data' => 'required|array',
        'type' => 'required|array',
    ]);
    $ids = FormField::where('id_forms', $request->id)->value('id');
    // return $id;
    // Find the existing record by custom field 'id_forms'
    $formField = FormField::find($ids);
    // Debugging: Check if the formField is found
    // dd($formField);

    if (!$formField) {
        return redirect()->back()->with('error', 'Form not found.');
    }

    // Combine data and type fields
    $labels = [];
    $types = [];
    
    foreach ($request->data as $index => $data) {
        $labels[] = $data;
        $types[] = $request->type[$index];
    }

    // Convert arrays into comma-separated strings
    $labelsString = implode('|', $labels);
    $typesString = implode('|', $types);

    // Debugging: Check the combined strings
    // dd($labelsString);
    // dd($typesString);

    // Update the fields
    $formField->label = $labelsString;
    $formField->type = $typesString;
    $formField->update(); // Use save() instead of update() to persist changes

    // Redirect or return response
    return redirect(route('admin.form-show',$id))->with('success', 'Form data updated successfully!');
}

public function editForm($id)
{
     // Find the form field by 'id_forms' or your primary key
     $formField = FormField::where('id', $id)->firstOrFail();

     // Ensure that the label and type fields are strings
     $labels = explode('|', $formField->label);
     $types = explode('|', $formField->type);
 
     // Pass the data to the view
     return view('forms.edit', [
         'formField' => $formField,
         'labels' => $labels,
         'types' => $types,
     ]);
 }

public function updateForm(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'data.*' => 'required|string|max:255',
            'type.*' => 'required|in:text,number,email,date',
        ]);

        // Find the FormField model by ID
        $formField = FormField::findOrFail($id);

        // Extract data and types from the request
        $data = $request->input('data');
        $types = $request->input('type');

        // Convert arrays to comma-separated strings
        $labelsString = implode(',', $data);
        $typesString = implode(',', $types);

        // Update the model with the new values
        $formField->label = $labelsString; // Assuming 'label' is the column to store labels
        $formField->type = $typesString;   // Assuming 'type' is the column to store types
        $formField->save();

        $back = FormField::where('id',$id)->value('id_forms');

        // Redirect or respond with a success message
        return redirect()->route('admin.form-show',$back)->with('success', 'Form fields updated successfully.');
    }


}
