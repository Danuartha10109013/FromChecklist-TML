<?php

namespace App\Http\Controllers;

use App\Models\FormsModel;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index(){
        return view('admin.form.index');
    }
    public function show($id){
        $data = FormsModel::where('id', $id)->get();
        return view('admin.form.shows',compact('data'));
    }
}
