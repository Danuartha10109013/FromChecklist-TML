<?php

namespace App\Http\Controllers;

use App\Models\FormField;
use App\Models\FormsModel;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormPegawaiController extends Controller
{
    public function create($id)
    {
        $title = FormsModel::where('id', $id)->value('nama');
        $data = FormField::where('id_forms',$id)->get();
        $id_field = FormField::where('id_forms',$id)->value('id');
        // dd($data);
        return view('pegawai.create', compact('data', 'title','id_field','id'));
    }

        public function store(Request $request, $id, $id_field)
        {
            // Get all the form data
            $formData = $request->except(['_token', 'field_id', 'form_id']); // Exclude CSRF token and hidden fields
    
            // Prepare the data for insertion
            $values = [];
            foreach ($formData as $key => $value) {
                $values[] = $value; // Collect all form values
            }
            // dd($formData);
            $valueString = implode('|', $values); // Join values with commas
    
            // Create a new FormSubmission entry
            FormSubmission::create([
                'form_fields_id' => $id_field,
                'form_id' => $id,
                'values' => $valueString,
                'user_id' => Auth::user()->id,
            ]);
    
            // Redirect or return a response
            return redirect()->route('pegawai.form-hasil')->with('success', 'Form submitted successfully!');
        }
        public function hasil()
{
    // Retrieve the form submission data
    $formSubmissions = FormSubmission::where('user_id', Auth::user()->id)->get();
    
    $formData = [];

    foreach ($formSubmissions as $submission) {
        $form = FormsModel::find($submission->form_id); // Get the form name
        $fieldIds = explode('|', $submission->form_fields_id);
        $values = $submission->values;
        $valuess = $submission->values;

        $labels = FormField::whereIn('id', $fieldIds)->pluck('label', 'id')->toArray();

        $formData[$form->nama][] = [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    return view('pegawai.record', compact('formData','valuess'));
}


        
    }
