<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Modalidades;
use App\Propuesta;
use App\PropuestaPractica;
use App\DesarrolloPractica;
use App\Desarrollo;
use App\Novedades;
use App\Banco;
use App\Conceptos;


class DocentesController extends Controller
{
    public function index(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('docente');
        $propuestas=Propuesta::all()->where('prop_dir_usu_id',$request->user()->id);
        $propuestasc=Propuesta::all()->where('prop_codir_usu_id',$request->user()->id);
        $desarrollo=Desarrollo::all()->where('des_dir_usu_id',$request->user()->id);
        $desarrolloc=Desarrollo::all()->where('des_codir_usu_id',$request->user()->id);
        $banco=Banco::all()->where('ban_usu_id',$request->user()->id);
        $propPractica=PropuestaPractica::all()->where('pp_dir_usu_id',$request->user()->id);
        $desPractica=DesarrolloPractica::all()->where('dp_dir_usu_id',$request->user()->id);
        $calificar=Conceptos::all()->where('con_usu_id',$request->user()->id);
        return view("docentes.index",compact('propuestas','propuestasc','desarrollo','desarrolloc','banco','calificar','propPractica','desPractica'));
    }
    //redirige al formulario para calificar
    public function edit(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('docente');
        $concepto=Conceptos::find($id);
        if($concepto->con_usu_id != $request->user()->id){
            return abort(401,'Pagina no autorizada');
        }
        return view('docentes.edit',compact('concepto'));
    }
    //actualiza el concepto
    public function update(Request $request, $id){
        
        $concepto=Conceptos::find($id);
        $concepto->con_nombre=$request->con_nombre;
        $concepto->con_acta=$request->con_acta;
        $concepto->con_fecha=date('Y-m-d');
        $concepto->save();
        return redirect()->route('docentes.index');
    }

    //redirige al formulario para asignar la fecha de sustentacion
    public function sustentacion(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('docente');
        $desarrollo=Desarrollo::find($id);
        return view('docentes.sustentacion',compact('desarrollo'));
    }
    
    //asigna la fecha de sustentacion
    public function setSustentacion(Request $request, $id){
        $desarrollo=Desarrollo::find($id);
        $desarrollo->des_citacion=$request->input('fecha');
        $desarrollo->save();
        return redirect()->route('docentes.index');
    }

    //descargar el formato de la propuesta seleccionada
    public function downloadPropuesta($id){
        $propuesta=Propuesta::find($id);
        $ruta=$propuesta->prop_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
    }
    //descargar el formato final seleccionado
    public function downloadDesarrollo($id){
        $desarrollo=Desarrollo::find($id);
        $ruta=$desarrollo->des_formato;
        return response()->download(public_path()."/files/desarrollo/$ruta");
    }
    //descargar el formato de la propuesta de practica seleccionada
    public function downloadPropuestaPractica($id){
        $propuesta=PropuestaPractica::find($id);
        $ruta=$propuesta->pp_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
    }
    //descargar el formato final de practica seleccionado
    public function downloadDesarrolloPractica($id){
        $desarrollo=DesarrolloPractica::find($id);
        $ruta=$desarrollo->dp_formato;
        return response()->download(public_path()."/files/desarrollo/$ruta");
    }
}
