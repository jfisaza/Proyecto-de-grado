<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Trabajos;

class EstudiantesController extends Controller
{
    public function index(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        $usuarios=User::all()->where('trabajo',$request->user()->trabajo);
        return view("estudiantes.index", compact('usuarios'));
    }
}