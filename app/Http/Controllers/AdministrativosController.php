<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propuesta;


class AdministrativosController extends Controller
{
    public function index(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $propuestas=Propuesta::all();

        return view("administrativos.index",compact("propuestas"));


    }

    public function propuestaDownload(Request $request){
        $propuesta=Propuesta::all();
        $ruta=$propuesta->prop_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
        
    }






}
