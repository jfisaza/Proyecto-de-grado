<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PropuestasExport;
use App\Exports\DesarrollosExport;
use App\Exports\AuditoriaPropuestaExport;
use App\Exports\AuditoriaDesarrolloExport;
use App\Exports\PropuestasPracticaExport;
use App\Exports\DesarrollosPracticaExport;
use App\Exports\AuditoriaPropuestaPracticaExport;
use App\Exports\AuditoriaDesarrolloPracticaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\PropuestaPractica;
use App\DesarrolloPractica;
use App\Propuesta;
use App\Desarrollo;
use App\Conceptos;
use App\User;
use App\Auditoria_propuesta;
use App\Auditoria_desarrollo;
use App\Auditoria_propuesta_practicas;
use App\Auditoria_desarrollo_practicas;
use App\Empresas;
use App\Exports\AuditoriaPropuestasPracticaExport;
use App\Solicitudes;
use App\Restricciones;

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
        $app=Auditoria_propuesta_practicas::codigo($request->get('app_id'));
        $apd=Auditoria_desarrollo_practicas::codigo($request->get('adp_id'));
        $empresas=Empresas::all();
        $pp=PropuestaPractica::paginate();
        $pd=DesarrolloPractica::paginate();
        $solicitudes=Solicitudes::paginate();
        $docentes=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.documento','users.nombres','users.apellidos','users.telefono','users.email')->where('roles_user.roles_rol_id','2')->get();
        $administrativos=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.documento','users.nombres','users.apellidos','users.telefono','users.email')->where('roles_user.roles_rol_id','1')->get();
        $restriccion=Restricciones::get()->first();
        return view("administrativos.index",compact("propuestas","desarrollo","ap","ad","docentes","empresas","solicitudes","administrativos","pp","pd","app","apd","restriccion"));
    }
    //redirige al formulario para crear una empresa
    public function create(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return view("administrativos.create");
    }
    //crear una empresa
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
    //redirige al formulario para editar los datos de una empresa
    public function edit(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $empresa=Empresas::find($id);
        return view("administrativos.edit",compact('empresa'));
    }
    //actualizar datos de una empresa
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
    //funciones para eliminar una empresa
    public function show($id){
        return $this->destroy($id);
    }
    public function destroy($id){
        try {
            $empresa=Empresas::find($id)->delete();
        } catch (\Throwable $th) {
            return redirect()->route('administrativos.index')
            ->with('error','No se puede eliminar esta empresa debido a que hay solicitudes de practicantes relacionadas a ella');
        }
        
        return redirect()->route('administrativos.index');
    }

    //redirige al formulario para cambiar el director y codirector de una propuesta
    public function cambiarDirectoresPropuesta(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');

        $propuesta=Propuesta::find($id);
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view('administrativos.directores',compact('propuesta','usuarios'));
    }
    //cambia el director y codirector de una propuesta
    public function setDirectoresPropuesta(Request $request, $id){
        $propuesta=Propuesta::find($id);
        $propuesta->prop_dir_usu_id=$request->input('prop_dir_usu_id');
        $propuesta->prop_codir_usu_id=$request->input('prop_codir_usu_id');
        $propuesta->save();

        return redirect()->route('administrativos.index');
    }
    //redirige al formulario para cambiar el director y codirector de un desarrollo
    public function cambiarDirectoresDesarrollo(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');

        $desarrollo=Desarrollo::find($id);
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view('administrativos.directoresDesarrollo',compact('desarrollo','usuarios'));
    }
    //cambia el director y codirector de un desarrollo
    public function setDirectoresDesarrollo(Request $request, $id){
        $desarrollo=Desarrollo::find($id);
        $desarrollo->des_dir_usu_id=$request->input('des_dir_usu_id');
        $desarrollo->des_codir_usu_id=$request->input('des_codir_usu_id');
        $desarrollo->save();

        return redirect()->route('administrativos.index');
    }
    //redirige al formulario para asignar calificador a una propuesta
    public function asignarPropuesta(Request $request,$id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $propuesta=Propuesta::find($id);
        $docentes=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view('administrativos.asignarPropuesta',compact('propuesta','docentes'));
    }
    //asigna el calificador a una propuesta creando un concepto
    public function asignarCalificadorPropuesta(Request $request){
        
        $concepto=new Conceptos();
        $concepto->con_nombre='ESPERA';
        $concepto->con_usu_id=$request->input('con_usu_id');
        $concepto->save();
        $id=DB::table('conceptos')->max('con_id');
        $propuesta=Propuesta::find($request->prop_id)->update(['prop_con_id'=>$id]);
        return redirect()->route('administrativos.index');

    }
    //redirige al formulacio para asignar calificador a propuesta de practica
    public function asignarPropuestaPractica(Request $request,$id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $propuesta=PropuestaPractica::find($id);
        $docentes=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view('administrativos.asignarPropuestaPractica',compact('propuesta','docentes'));
    }
    //asigna el calificador a la propuesta practica
    public function asignarCalificadorPropuestaPractica(Request $request){
        
        $concepto=new Conceptos();
        $concepto->con_nombre='ESPERA';
        $concepto->con_usu_id=$request->input('con_usu_id');
        $concepto->save();
        $id=DB::table('conceptos')->max('con_id');
        $propuesta=PropuestaPractica::find($request->pp_id)->update(['pp_con_id'=>$id]);
        return redirect()->route('administrativos.index');

    }
    //redirige al formulario de asignar calificador de trabajo final
    public function asignarDesarrollo(Request $request,$id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $desarrollo=Desarrollo::find($id);
        $docentes=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view('administrativos.asignarDesarrollo',compact('desarrollo','docentes'));
    }
    //asigna el calificador a trabajo final
    public function asignarCalificadorDesarrollo(Request $request){
        
        $concepto=new Conceptos();
        $concepto->con_nombre='ESPERA';
        $concepto->con_usu_id=$request->input('con_usu_id');
        $concepto->save();
        $id=DB::table('conceptos')->max('con_id');
        $desarrollo=Desarrollo::find($request->des_id)->update(['des_con_id'=>$id]);
        return redirect()->route('administrativos.index');

    }
    //redirige al formulario para asignar calificador a trabajo final de practica
    public function asignarDesarrolloPractica(Request $request,$id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        $desarrollo=DesarrolloPractica::find($id);
        $docentes=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view('administrativos.asignarDesarrolloPractica',compact('desarrollo','docentes'));
    }
    //asigna el calificador a trabajo final de practica
    public function asignarCalificadorDesarrolloPractica(Request $request){
        
        $concepto=new Conceptos();
        $concepto->con_nombre='ESPERA';
        $concepto->con_usu_id=$request->input('con_usu_id');
        $concepto->save();
        $id=DB::table('conceptos')->max('con_id');
        $desarrollo=DesarrolloPractica::find($request->dp_id)->update(['dp_con_id'=>$id]);
        return redirect()->route('administrativos.index');

    }
    //funciones para descargar formatos de cada tabla (propuestas,final,practicas y auditorias)
    public function downloadPropuesta($id){
        $propuesta=Propuesta::find($id);
        $ruta=$propuesta->prop_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
    }
    public function downloadPropuestaPractica($id){
        $propuesta=PropuestaPractica::find($id);
        $ruta=$propuesta->pp_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
    }

    public function downloadDesarrollo($id){
        $desarrollo=Desarrollo::find($id);
        $ruta=$desarrollo->des_formato;
        return response()->download(public_path()."/files/desarrollo/$ruta");
    }
    public function downloadDesarrolloPractica($id){
        $desarrollo=DesarrolloPractica::find($id);
        $ruta=$desarrollo->dp_formato;
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
    //funciones para descargar liquidaciones
    public function downloadLiquidacionPropuesta($id){
        $propuesta=Propuesta::find($id);
        $ruta=$propuesta->prop_liquidacion;
        return response()->download(public_path()."/files/liquidaciones/$ruta");
    }
    public function downloadLiquidacionPractica($id){
        $propuesta=PropuestaPractica::find($id);
        $ruta=$propuesta->pp_liquidacion;
        return response()->download(public_path()."/files/liquidaciones/$ruta");
    }
    //asigna el rol de docente a un usuario
    public function setRolDocente(Request $request){
        $usuario=User::where('documento',$request->input('documento'))->first();
        if(is_null($usuario)){
            return redirect()->route("administrativos.index")->with('error','Usuario no encontrado.');
        }
        $rol=DB::table('roles_user')->where('user_id',$usuario->id)->update(['roles_rol_id'=>2]);
        return redirect()->route('administrativos.index');
    }
    //asigna el rol de administrativo a un usuario
    public function setRolAdministrativo(Request $request){
        $usuario=User::where('documento',$request->input('documento'))->first();
        if(is_null($usuario)){
            return redirect()->route("administrativos.index")->with('error','Usuario no encontrado.');
        }
        $rol=DB::table('roles_user')->where('user_id',$usuario->id)->update(['roles_rol_id'=>1]);
        return redirect()->route('administrativos.index');
    }
    //asigna el rol de estudiante a un usuario quitando los roles de docente y administrador
    public function setRolEstudiante($id){
        $user=User::find($id);
        $rol=DB::table('roles_user')->where('user_id',$user->id)->update(['roles_rol_id'=>3]);
        return redirect()->route('administrativos.index');
    }
    //funciones para exportar tablas a documento de excel
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
    public function exportPropuestaPractica(Request $request) 
    {
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return Excel::download(new PropuestasPracticaExport, 'propuestas-practicas.xlsx');
    }
    public function exportDesarrolloPractica(Request $request) 
    {
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return Excel::download(new DesarrollosPracticaExport, 'trabajos-practicas.xlsx');
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
    public function exportAuditoriaPropuestaPractica(Request $request) 
    {
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return Excel::download(new AuditoriaPropuestasPracticaExport, 'AuditoriaPropuestasPracticas.xlsx');
    }
    public function exportAuditoriaDesarrolloPractica(Request $request) 
    {
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return Excel::download(new AuditoriaDesarrollosPracticaExport, 'AuditoriaTrabajosPracticas.xlsx');
    }
    //funcion para cambiar la fecha limite de registro de propuestas de trabajo de grado
    public function setFechaLimitePropuestas(Request $request){
        $restriccion=Restricciones::find(1)->update(['res_fecha'=>$request->input('fecha')]);
        return redirect()->route('administrativos.index');
    }

}
