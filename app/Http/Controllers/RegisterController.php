<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        //return view index yang ada di dalam folder register
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register',
        ]);
    }

    public function store(Request $request)
    {
        //untuk memvalidasi data form register dan jika sudah memenuhi semua maka simpan di variable $validateData
        //kalau validasi lolos, maka dia akan menjalankan code dibawahnya
        $validatedData = $request->validate(
            [
                'name' => 'required|max:255',
                //username harus uniques dari table users dan minimal kata adalah 3 dan maksimal 255
                'username' => ['required', 'min:3', 'max:255', 'unique:users'],
                //email harus unique dari table users dan formatnya harus email
                'email' => 'required|email:dns|unique:users',
                'password' => 'required|min:5|max:255'
            ]
        );



        //$validatedData['password'] = bcrypt($validatedData['password']);

        //kode untuk mengenskripsi password
        $validatedData['password'] = Hash::make($validatedData['password']);

        //kode dibawah untuk menyimpan data register ke model User yang terhubung dengan table users
        User::create($validatedData);

        // Jika menggunakan flash (baca flash storage di php)
        // $request->session()->flash('success', 'Registration Success! Please Login');

        //mengarahkan ke halaman login sambil mengrimikan pesan yang keynya sukses
        return redirect('/login')->with('success', 'Registration Success! Please Login');
    }
}
