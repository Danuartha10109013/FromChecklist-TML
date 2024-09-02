<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('auth.index');
    }

    public function login_proses(Request $request)
{
    // Validasi input
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Mencoba mencari user berdasarkan username
    $user = User::where('username', $request->username)->first();

    // Jika user tidak ditemukan
    if (!$user) {
        return redirect()->back()->with('error', 'Username tidak ditemukan.');
    }

    // Memeriksa kecocokan password
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Password salah.');
    }

    // Autentikasi berhasil
    Auth::login($user);

    // Cek peran pengguna setelah login berhasil
    if ($user->role == 1) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role == 2) {
        return redirect()->route('pegawai.dashboard');
    }

    // Redirect ke halaman dashboard default jika role tidak dikenali
    return redirect()->route('dashboard')->with('success', 'Login berhasil.');
}



    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('succes', 'Kamu berhasil Logout');
    }
}
