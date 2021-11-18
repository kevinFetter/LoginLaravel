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
        //var_dump($request->all());
        //validar se o Email é válido
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL))
        {
            return redirect()->back()->withInput()->withErrors(['E-mail inválido !']);
        }

        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password
        ];
        //vai fazer uma tentativa de login com array associativa
        if(Auth::attempt($credentials)){
            return redirect()->route('admin');    
        };
        //valida se tiver erro
        //withInput faz persistir os dados e o withErros valida se tem erro e informa mensagem
        return redirect()->back()->withInput()->withErrors(['Dados informados não confererem!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}
