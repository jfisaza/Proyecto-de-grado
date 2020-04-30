<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        $credentials = $this->validate(request(), [
            'usu_correo' => 'email|required|string',
            'usu_clave' => 'required|string'
        ]);

        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['usu_correo' => trans('auth.failed')])->withInput(request(['usu_correo']));
    }
}
