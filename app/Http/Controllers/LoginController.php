<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        //return view index yang ada di dalam folder login
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login',
        ]);
    }

    public function authenticate(Request $request)
    {
        //validasi email dan password
        //jika validasi gagal maka kode dibawah tidak akan dijalankan
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|',
        ]);

        //jika percobaan login berhasil maka kode di dalamnya akan dijalankan
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            //mengarahkan ke halaman dashboard
            //mengarahkan ke sebuah halaman menggunakan itended karena
            return redirect()->intended('dashboard');
        }

        //jika percobaan login gagal, maka kirimkan key LoginError dan kembali ke halaman login
        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //mengarahkan ke halaman home
        return redirect('/');
    }
}
