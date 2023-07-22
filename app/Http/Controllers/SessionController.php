<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function index()
    {
        return view('sesi.index');
    }


    public function login(Request $request)
    {
        Session::flash('email', $request->email);


        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => "E-mail Wajib diisi!",
            'email.email' => "Silahkan masukan Email yang valid!",
            'password.required' => "Password Wajib diisi!",
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = $request->has('remember');

        if (Auth::attempt($infologin, $remember)) {
            return redirect('/')->with('success', Auth::user()->name . ' Anda Berhasil Login!');
        } else {
            return redirect('sesi')->withErrors('E-mail atau Password yang anda masukan tidak valid');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('sesi')->with('success', 'Anda Berhasil Logout!');
    }

    public function register()
    {
        return view('sesi.register');
    }

    public function create(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);

        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:6',
        ], [
            'email.required' => "E-mail Wajib diisi!",
            'email.email' => "Silahkan Masukan Email Yang Valid!",
            'email.unique' => "E-Mail Sudah Pernah digunakan Silahkan Pilih E-mail Yang Lain",
            'name.required' => "Nama Wajib diisi!",
            'password.required' => "Password Wajib diisi!",
            'password.min' => "Minimum Password 6 Karakter!",
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        User::create($data);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            return redirect('/')->with('success', Auth::user()->name . ' Anda Berhasil Login!');
        } else {
            return redirect('sesi')->withErrors('E-mail atau Password yang anda masukan tidak valid');
        }
    }
}
