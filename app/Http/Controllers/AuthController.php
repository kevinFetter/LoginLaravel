<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard()
    {
        if(Auth::check() === true) 
        {
            //dd(Auth::user());
            return view('admin.dashboard');
        }

        return redirect()->route('admin.login');
    }

    public function showLoginForm()
    {
        return view('admin.formLogin');
    }


    public function login(Request $request)
    {
        var_dump($request->all());

        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        //vai fazer uma tentativa de login com array associativa
        Auth::attempt($credentials);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }

}
