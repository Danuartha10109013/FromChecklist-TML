<?php

namespace App\Http\Controllers;

use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{public function index()
    {
        $fields = FormField::all();
        return view('admin.form_fields.index', compact('fields'));
    }
    
    public function create()
    {
        return view('admin.form_fields.create');
    }
    
    public function store(Request $request)
    {
        FormField::create($request->all());
        return redirect()->route('form-fields.index')->with('success', 'Field added successfully.');
    }
    
    public function edit($id)
    {
        $field = FormField::find($id);
        return view('admin.form_fields.edit', compact('field'));
    }
    
    public function update(Request $request, $id)
    {
        $field = FormField::find($id);
        $field->update($request->all());
        return redirect()->route('form-fields.index')->with('success', 'Field updated successfully.');
    }
    
    public function destroy($id)
    {
        $field = FormField::find($id);
        $field->delete();
        return redirect()->route('form-fields.index')->with('success', 'Field deleted successfully.');
    }
    
}
