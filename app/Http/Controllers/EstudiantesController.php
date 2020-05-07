<?php

namespace App\Http\Controllers;

use App\Propuestas;
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
        $usuarios=User::all()->where('propuesta',$request->user()->propuesta);
        return view("estudiantes.index", compact('usuarios'));
    }

    public function create(){
        return $this->crearPropuesta();
    }

    private function crearPropuesta(){
        
    $propuesta=Propuestas::all();
    return view('estudiantes.create',compact('propuesta'));
    }

    public function store(Request $request)
    {
        
        //
        $this->validate($request,['prop_titulo'=>'required',
        'prop_mod_id'=>'required']);
        Propuestas::create($request->all());
        
        return redirect()->route('estudiantes.index')->with('Mensaje',' AGREGADO EXITOSAMENTE ');
    }
}
