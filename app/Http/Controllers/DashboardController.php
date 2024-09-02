<?php

namespace App\Http\Controllers;

use App\Models\FormsModel;
use App\Models\KateFormsModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        return view('index');
    }
}
