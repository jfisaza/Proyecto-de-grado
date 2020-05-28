<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PropuestasExport;
use App\Exports\DesarrollosExport;
use App\Exports\AuditoriaPropuestaExport;
use App\Exports\AuditoriaDesarrolloExport;
use Maatwebsite\Excel\Facades\Excel;
use App\PropuestaPractica;
use App\DesarrolloPractica;
use App\Propuesta;
use App\Desarrollo;
use App\Conceptos;
use App\User;
use App\Auditoria_propuesta;
use App\Auditoria_desarrollo;
use App\Empresas;
use App\Solicitudes;

class AdministrativosController extends Controller
{
    public function index(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $propuestas=Propuesta::codigo($request->get('prop_id'))->paginate();
        $desarrollo=Desarrollo::codigo($request->get('des_id'))->paginate();
        $ap=Auditoria_propuesta::codigo($request->get('ap_id'))->paginate();
        $ad=Auditoria_desarrollo::codigo($request->get('ad_id'))->paginate();
        $empresas=Empresas::paginate();
        $pp=PropuestaPractica::paginate();
        $pd=DesarrolloPractica::paginate();
        $solicitudes=Solicitudes::paginate();
        $docentes=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.documento','users.nombres','users.apellidos','users.telefono','users.email')->where('roles_user.roles_rol_id','2')->get();
        $administrativos=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.documento','users.nombres','users.apellidos','users.telefono','users.email')->where('roles_user.roles_rol_id','1')->get();
        return view("administrativos.index",compact("propuestas","desarrollo","ap","ad","docentes","empresas","solicitudes","administrativos","pp","pd"));
    }

    public function create(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return view("administrativos.create");
    }

    public function store(Request $request){
        $empresa=new Empresas();
        $empresa->emp_nombre=strtoupper($request->input('emp_nombre'));
        $empresa->emp_sector=$request->input('emp_sector');
        $empresa->emp_representante=strtoupper($request->input('emp_representante'));
        $empresa->emp_direccion=$request->input('emp_direccion');
        $empresa->emp_telefono=$request->input('emp_telefono');
        $empresa->emp_correo=$request->input('emp_correo');
        $empresa->save();
        return redirect()->route('administrativos.index');
    }

    public function edit(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $empresa=Empresas::find($id);
        return view("administrativos.edit",compact('empresa'));
    }

    public function update(Request $request, $id){
        $empresa=Empresas::find($id);
        $empresa->emp_nombre=strtoupper($request->input('emp_nombre'));
        $empresa->emp_sector=$request->input('emp_sector');
        $empresa->emp_representante=strtoupper($request->input('emp_representante'));
        $empresa->emp_direccion=$request->input('emp_direccion');
        $empresa->emp_telefono=$request->input('emp_telefono');
        $empresa->emp_correo=$request->input('emp_correo');
        $empresa->save();
        return redirect()->route('administrativos.index');
    }
    public function show($id){
        return $this->destroy($id);
    }
    public function destroy($id){
        $empresa=Empresas::find($id)->delete();
        return redirect()->route('administrativos.index');
    }

    public function asignarPropuesta(Request $request,$id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $propuesta=Propuesta::find($id);
        $docentes=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view('administrativos.asignarPropuesta',compact('propuesta','docentes'));
    }

    public function asignarCalificadorPropuesta(Request $request){
        
        $concepto=new Conceptos();
        $concepto->con_nombre='ESPERA';
        $concepto->con_usu_id=$request->input('con_usu_id');
        $concepto->save();
        $id=DB::table('conceptos')->max('con_id');
        $propuesta=Propuesta::find($request->prop_id)->update(['prop_con_id'=>$id]);
        return redirect()->route('administrativos.index');

    }

    public function asignarDesarrollo(Request $request,$id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $desarrollo=Desarrollo::find($id);
        $docentes=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view('administrativos.asignarDesarrollo',compact('desarrollo','docentes'));
    }

    public function asignarCalificadorDesarrollo(Request $request){
        
        $concepto=new Conceptos();
        $concepto->con_nombre='ESPERA';
        $concepto->con_usu_id=$request->input('con_usu_id');
        $concepto->save();
        $id=DB::table('conceptos')->max('con_id');
        $desarrollo=Desarrollo::find($request->des_id)->update(['des_con_id'=>$id]);
        return redirect()->route('administrativos.index');

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

    public function downloadAuditoriaPropuesta($id){
        $propuesta=Auditoria_propuesta::find($id);
        $ruta=$propuesta->ap_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
    }

    public function downloadAuditoriaDesarrollo($id){
        $desarrollo=Auditoria_desarrollo::find($id);
        $ruta=$desarrollo->ad_formato;
        return response()->download(public_path()."/files/desarrollo/$ruta");
    }

    public function setRolDocente(Request $request){
        $docente=User::where('documento',$request->input('documento'))->first();
        if(is_null($docente)){
            return redirect()->route("administrativos.index")->with('error','Usuario no encontrado.');
        }
        $rol=DB::table('roles_user')->where('user_id',$docente->id)->update(['roles_rol_id'=>2]);
        return redirect()->route('administrativos.index');
    }
    public function setRolAdministrativo(Request $request){
        $docente=User::where('documento',$request->input('documento'))->first();
        if(is_null($docente)){
            return redirect()->route("administrativos.index")->with('error','Usuario no encontrado.');
        }
        $rol=DB::table('roles_user')->where('user_id',$docente->id)->update(['roles_rol_id'=>1]);
        return redirect()->route('administrativos.index');
    }

    public function setRolEstudiante($id){
        $user=User::find($id);
        $rol=DB::table('roles_user')->where('user_id',$user->id)->update(['roles_rol_id'=>3]);
        return redirect()->route('administrativos.index');
    }

    public function exportPropuesta(Request $request) 
    {
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return Excel::download(new PropuestasExport, 'propuestas.xlsx');
    }
    public function exportDesarrollo(Request $request) 
    {
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return Excel::download(new DesarrollosExport, 'trabajos.xlsx');
    }
    public function exportAuditoriaPropuesta(Request $request) 
    {
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return Excel::download(new AuditoriaPropuestaExport, 'AuditoriaPropuestas.xlsx');
    }
    public function exportAuditoriaDesarrollo(Request $request) 
    {
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return Excel::download(new AuditoriaDesarrolloExport, 'AuditoriaTrabajos.xlsx');
    }

}
