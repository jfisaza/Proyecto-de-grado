<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function edit(){
        return view('user.edit');
    }
    protected function update(array $data)
    {
        
        $user = User::update([
            'documento' => $data['documento'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'telefono' => $data['telefono'],
            'ciudad' => $data['ciudad'],
            'programa' => $data['programa'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        return $user;

    }
}
