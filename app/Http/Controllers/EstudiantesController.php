<?php

namespace App\Http\Controllers;

use App\Propuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\propuesta_user;

class EstudiantesController extends Controller
{
    public function index(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        $estudiantes=User::all()->where('propuesta',$request->user()->propuesta);
        return view("estudiantes.index", compact("estudiantes"));
    }

    public function create(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        return view("estudiantes.create");
    }

    

    public function store(Request $request)
    {
        if($request->hasFile('prop_formato')){
            $file = $request->file('prop_formato');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/',$name);
        }
        
        $this->validate($request,['prop_titulo'=>'required',
        'prop_dir_usu_id'=>'required',
        'prop_mod_id'=>'required']);
        $propuesta=new Propuesta();
        $propuesta->prop_titulo=$request->input('prop_titulo');
        $propuesta->prop_dir_usu_id=$request->input('prop_dir_usu_id');
        $propuesta->prop_codir_usu_id=$request->input('prop_codir_usu_id');
        $propuesta->prop_mod_id=$request->input('prop_mod_id');
        $propuesta->prop_formato=$name;
        $propuesta->save();
        return $this->enlazarPropuestaUser($request,$propuesta);
    }
    public function enlazarPropuestaUser(Request $request, $pro){
        $propuesta=Propuesta::where('prop_titulo',$pro->prop_titulo)->first();
        $userid=$request->user()->id;
        $user=User::find($userid);
        $user->propuesta=$propuesta->prop_id;
        $user->save();
        return redirect()->route("estudiantes.index");
    }
   
    public function download(Request $request){
        $propuesta=Propuesta::find($request->user()->propuesta);
        $ruta=$propuesta->prop_formato;
        return response()->download(public_path()."/files/$ruta");
        
    }
}
