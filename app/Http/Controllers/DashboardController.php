<?php

namespace App\Http\Controllers;

use App\Models\FormsModel;
use App\Models\KateFormsModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = User::count();
        $form = FormsModel::count();
        return view('index',compact('user','form'));
    }
}
