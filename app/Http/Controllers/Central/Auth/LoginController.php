<?php

namespace App\Http\Controllers\Central\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function loginForm()
    {
        return Inertia::render('Central/Auth/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Informe um e-mail',
                'email.email' => 'Digite um e-mail válido',
                'password.required' => 'Informe a senha',
            ]
        );

        if( ! Auth::attempt($credentials) )
        {
            return back()->withErrors([
                    'message' => 'Usuário e/ou senha inválido(s)!'
            ])->onlyInput('email');
        }

        return redirect()->route('central.dashboard.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('central.login');
    }
}
