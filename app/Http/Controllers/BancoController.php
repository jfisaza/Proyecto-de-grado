<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banco;
use App\Programas;
use App\Solicitudes;
use App\Modalidades;
use App\User;
use App\Empresas;

class BancoController extends Controller
{
    public function index(Request $request){
        
        $banco=Banco::programas($request->get('ban_pro_id'))->paginate();
        $solicitud=Solicitudes::programas($request->get('ban_pro_id'))->paginate();
        $programa=Programas::all();
        return view("banco_ideas.index", compact("banco","solicitud","programa"));
    }
    public function create(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeManyRoles('docente','administrativo');
        $modalidades=Modalidades::all();
        $programas=Programas::all();
        return view("banco_ideas.create",compact('modalidades','programas'));
    }
    public function store(Request $request){
        $banco=new Banco();
        $banco->ban_nombre=$request->input('ban_nombre');
        $banco->ban_usu_id=$request->user()->id;
        $banco->ban_mod_id=$request->input('ban_mod_id');
        $banco->ban_pro_id=$request->input('ban_pro_id');
        $banco->save();
        return redirect()->route('docentes.index');
    }

    public function edit(Request $request,$id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeManyRoles('docente','administrativo');
        $banco=Banco::find($id);
        if($banco->ban_usu_id != $request->user()->id){
            return abort(401,'Pagina no autorizada');
        }
        $modalidades=Modalidades::all();
        $programas=Programas::all();
        
        return view("banco_ideas.edit",compact('banco','modalidades','programas'));
    }

    public function update(Request $request, $id){
        $banco=Banco::find($id)->update(['ban_nombre'=>$request->ban_nombre],
                ['ban_mod_id'=>$request->ban_mod_id],['ban_pro_id'=>$request->ban_pro_id]);
        return redirect()->route('docentes.index');
    }

    public function show($id){
        return $this->destroy($id);
    }

    public function destroy($id){
        $banco=Banco::find($id)->delete();
        return redirect()->route('docentes.index');
    }

    public function createSolicitud(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $empresas=Empresas::all();
        $programas=Programas::all();
        return view('banco_ideas.createSolicitud',compact('empresas','programas'));
    }

    public function storeSolicitud(Request $request){
        $solicitud=new Solicitudes();
        $solicitud->sol_emp_id=$request->input('sol_emp_id');
        $solicitud->sol_pro_id=$request->input('sol_pro_id');
        $solicitud->save();
        return redirect()->route('administrativos.index');
    }

    public function editSolicitud(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $solicitud=Solicitudes::find($id);
        $empresas=Empresas::all();
        $programas=Programas::all();
        return view('banco_ideas.editSolicitud', compact('solicitud','empresas','programas'));
    }

    public function updateSolicitud(Request $request, $id){
        $solicitud=Solicitudes::find($id);
        $solicitud->sol_emp_id=$request->input('sol_emp_id');
        $solicitud->sol_pro_id=$request->input('sol_pro_id');
        $solicitud->save();
        return redirect()->route('administrativos.index');
    }

    public function destroySolicitud($id){
        $solicitud=Solicitudes::find($id)->delete();
        return redirect()->route('administrativos.index');
    }
}
