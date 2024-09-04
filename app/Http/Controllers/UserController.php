<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data= User::all();
        return view('admin.user.index',compact('data'));
    }
    public function create(){
        return view('admin.user.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role; // default role 2
        $user->active = $request->active; // default status 2
        $user->save();

        return redirect()->route('admin.user')->with('success', 'User created successfully.');
    }

    public function edit($id){
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|integer',
            'active' => 'required|integer',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->role = $request->role;
        $user->active = $request->active;
        $user->save();

        return redirect()->route('admin.user')->with('success', 'User updated successfully.');
    }

    public function active($id) {
        // Temukan data berdasarkan ID
        $data = User::find($id);
    
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
        $data = User::find($id);
    
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
        $data = user::find($id);
    
        if ($data) {
            $data->delete();
            return redirect()->route('admin.user')->with('success', 'User berhasil dihapus.');
        } else {
            return redirect()->route('admin.user')->with('error', 'User tidak ditemukan.');
        }
    }
    
}
