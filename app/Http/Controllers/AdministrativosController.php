<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propuesta;
use App\Desarrollo;


class AdministrativosController extends Controller
{
    public function index(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $propuestas=Propuesta::paginate();
        $desarrollo=Desarrollo::paginate();
        return view("administrativos.index",compact("propuestas","desarrollo"));


    }

    public function downloadPropuesta($id){
        $propuesta=Propuesta::find($id);
        $ruta=$propuesta->prop_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
    }

    public function downloadDesarrollo($id){
        $desarrollo=Desarrollo::find($id);
        $ruta=$desarrollo->des_formato;
        return response()->download(public_path()."/files/desarrollo/$ruta");
    }






}
