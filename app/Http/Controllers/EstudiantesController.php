<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Modalidades;
use App\Propuesta;
use App\PropuestaPractica;
use App\Desarrollo;
use App\DesarrolloPractica;
use App\Novedades;
use App\Novedades_practicas;
use App\Programas;
use App\Auditoria_propuesta;
use App\Auditoria_desarrollo;
use App\Auditoria_novedades;
use App\Auditoria_propuesta_practicas;
use App\Auditoria_desarrollo_practicas;
use App\Auditoria_novedades_practicas;
use App\Empresas;

class EstudiantesController extends Controller
{
    //redirige a la pagina principal del proceso de trabajo de grado para el estudiante
    public function index(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        $estudiantes=User::all()->where('propuesta',$request->user()->propuesta);
        $estudiantesd=User::all()->where('desarrollo',$request->user()->desarrollo);
        $novedades=Novedades::all()->where('nov_des_id',$request->user()->desarrollo);

        $practicas=PropuestaPractica::where('pp_usu_id',$request->user()->id)->first();
        $desarrollo=DesarrolloPractica::where('dp_usu_id',$request->user()->id)->first();
        $novedadesp=Novedades_practicas::all()->where('np_dp_id',$request->user()->practicas->dp_id);
        if(isset($practicas)){
            return view('estudiantes.indexpractica',compact('practicas','desarrollo','novedadesp'));
        }
        return view("estudiantes.index", compact("estudiantes","estudiantesd","novedades"));
    }
    //redirige al formulario para crear una propuesta
    public function create(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        $modalidades=Modalidades::all();
        $programas=Programas::all();
        return view("estudiantes.create", compact("usuarios","modalidades","programas"));
    }
    
    //crea la propuesta
    public function store(Request $request)
    {
        if($request->hasFile('prop_formato')){
            $file = $request->file('prop_formato');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/propuesta/',$name);
        }
        
        $this->validate($request,['prop_titulo'=>'required',
        'prop_dir_usu_id'=>'required',
        'prop_mod_id'=>'required']);
        $propuesta=new Propuesta();
        $propuesta->prop_titulo=strtoupper($request->input('prop_titulo'));
        $propuesta->prop_dir_usu_id=$request->input('prop_dir_usu_id');
        $propuesta->prop_codir_usu_id=$request->input('prop_codir_usu_id');
        $propuesta->prop_mod_id=$request->input('prop_mod_id');
        $propuesta->prop_pro_id=$request->input('prop_pro_id');
        $propuesta->prop_formato=$name;
        $propuesta->save();
        return $this->enlazarPropuestaUser($request,$propuesta);
    }
    //redirige al formulario para editar la propuesta
    public function edit(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        if($request->user()->propuesta != $id){
            return abort(401,'Página no autorizada');
        }
        $request->user()->authorizeRoles('estudiante');
        $propuesta=Propuesta::find($id);
        $programas=Programas::all();
        $modalidades=Modalidades::all();
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view("estudiantes.edit", compact("propuesta","usuarios","programas","modalidades"));
    }
    //actualiza la propuesta
    public function update(Request $request, $id){
        $propuesta=Propuesta::find($id);
        $this->validate($request,['prop_titulo'=>'required',
        'prop_dir_usu_id'=>'required']);

        if($request->hasFile('prop_formato')){
            $file = $request->file('prop_formato');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/propuesta/',$name);
            unlink(public_path().'/files/propuesta/'.$propuesta->prop_formato);
            $propuesta->prop_formato=$name;
        }

        $propuesta->prop_titulo=strtoupper($request->input('prop_titulo'));
        $propuesta->prop_dir_usu_id=$request->input('prop_dir_usu_id');
        $propuesta->prop_codir_usu_id=$request->input('prop_codir_usu_id');
        $propuesta->prop_pro_id=$request->input('prop_pro_id');
        $propuesta->prop_mod_id=$request->input('prop_mod_id');
        $propuesta->save();
        return redirect()->route("estudiantes.index");
    }
    //enlaza la propuesta acabada de registrar con el estudiante que la registro
    public function enlazarPropuestaUser(Request $request, $pro){
        $propuesta=DB::table('propuesta')->max('prop_id');
        $userid=$request->user()->id;
        $user=User::find($userid);
        $user->propuesta=$propuesta;
        $user->save();
        return redirect()->route("estudiantes.index");
    }

    //redirecciona al formulario para crear una propuesta de practica
    public function createp(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        $empresas=Empresas::all();
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view("estudiantes.createpractica", compact("usuarios","empresas"));
    }
    //crear Propuesta Practica
    public function storep(Request $request)
    {
        if($request->hasFile('pp_formato')){
            $file = $request->file('pp_formato');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/propuesta/',$name);
        }
        
        $this->validate($request,['pp_titulo'=>'required',
        'pp_dir_usu_id'=>'required',
        'pp_numconvenio'=>'required']);
        $propuesta=new PropuestaPractica();
        $propuesta->pp_titulo=strtoupper($request->input('pp_titulo'));
        $propuesta->pp_usu_id=$request->user()->id;
        $propuesta->pp_emp_id=$request->input('pp_emp_id');
        $propuesta->pp_numconvenio=$request->input('pp_numconvenio');
        $propuesta->pp_fechaconvenio=$request->input('pp_fechaconvenio');
        $propuesta->pp_dir_usu_id=$request->input('pp_dir_usu_id');
        $propuesta->pp_pro_id=$request->user()->programa;
        $propuesta->pp_formato=$name;
        $propuesta->save();
        return redirect()->route('estudiantes.index');
    }
    //redirigir al formulario para editar propuesta Practica
    public function editp(Request $request,$id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        $practica=PropuestaPractica::find($id);
        $empresas=Empresas::all();
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view("estudiantes.editpractica", compact("usuarios","empresas","practica"));
    }
    //editar propuesta practica
    public function updatep(Request $request,$id)
    {
        $propuesta=PropuestaPractica::find($id);
        if($request->hasFile('pp_formato')){
            $file = $request->file('pp_formato');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/propuesta/',$name);
            $propuesta->pp_formato=$name;
        }
        
        $this->validate($request,['pp_titulo'=>'required',
        'pp_dir_usu_id'=>'required',
        'pp_numconvenio'=>'required']);
        
        $propuesta->pp_titulo=strtoupper($request->input('pp_titulo'));
        $propuesta->pp_usu_id=$request->user()->id;
        $propuesta->pp_emp_id=$request->input('pp_emp_id');
        $propuesta->pp_numconvenio=$request->input('pp_numconvenio');
        $propuesta->pp_fechaconvenio=$request->input('pp_fechaconvenio');
        $propuesta->pp_dir_usu_id=$request->input('pp_dir_usu_id');
        
        $propuesta->save();
        return redirect()->route('estudiantes.index');
    }
    //crea el registro en la tabla desarrollo
    public function crearDesarrollo(Request $request){
        $user=User::all()->where('propuesta',$request->user()->propuesta);
        $cont=0;
        foreach($user as $u){
            $array[$cont]=$u->id;
            $cont++;
        }
        $ap=new Auditoria_propuesta();
        $ap->ap_id=$request->user()->propuesta;
        $ap->ap_titulo=$request->user()->propuestas->prop_titulo;
        $ap->ap_est1=$array[0];
        if(isset($array[1])){
            $ap->ap_est2=$array[1];
        }
        if(isset($array[2])){
            $ap->ap_est3=$array[2];
        }
        
        $ap->ap_dir_usu_id=$request->user()->propuestas->prop_dir_usu_id;
        $ap->ap_codir_usu_id=$request->user()->propuestas->prop_codir_usu_id;
        $ap->ap_mod_id=$request->user()->propuestas->prop_mod_id;
        $ap->ap_pro_id=$request->user()->propuestas->prop_pro_id;
        $ap->ap_con_id=$request->user()->propuestas->prop_con_id;
        $ap->ap_formato=$request->user()->propuestas->prop_formato;
        $ap->save();

        $desarrollo=new Desarrollo();
        $desarrollo->des_id=$request->user()->propuesta;
        $desarrollo->des_titulo=$request->user()->propuestas->prop_titulo;
        $desarrollo->des_dir_usu_id=$request->user()->propuestas->prop_dir_usu_id;
        $desarrollo->des_codir_usu_id=$request->user()->propuestas->prop_codir_usu_id;
        $desarrollo->des_mod_id=$request->user()->propuestas->prop_mod_id;
        $desarrollo->des_pro_id=$request->user()->propuestas->prop_pro_id;
        $desarrollo->des_prop_id=$request->user()->propuesta;
        $desarrollo->save();
        $user=User::where('propuesta',$request->user()->propuesta)->update(['desarrollo'=>$desarrollo->des_id]);
        return redirect()->route("estudiantes.index");
    }
    //crear desarrollo practica
    public function crearDesarrolloPractica(Request $request,$id){
        $propuesta=PropuestaPractica::find($id);
        $desarrollo=new DesarrolloPractica();
        $app=new Auditoria_propuesta_practicas();

        $app->app_id=$propuesta->pp_id;
        $app->app_id=$propuesta->pp_id;
        $app->app_titulo=$propuesta->pp_titulo;
        $app->app_usu_id=$propuesta->pp_usu_id;
        $app->app_emp_id=$propuesta->pp_emp_id;
        $app->app_numconvenio=$propuesta->pp_numconvenio;
        $app->app_fechaconvenio=$propuesta->pp_fechaconvenio;
        $app->app_dir_usu_id=$propuesta->pp_dir_usu_id;
        $app->app_pro_id=$propuesta->pp_pro_id;
        $app->app_con_id=$propuesta->pp_con_id;
        $app->save();

        $desarrollo->dp_id=$propuesta->pp_id;
        $desarrollo->dp_titulo=$propuesta->pp_titulo;
        $desarrollo->dp_usu_id=$propuesta->pp_usu_id;
        $desarrollo->dp_emp_id=$propuesta->pp_emp_id;
        $desarrollo->dp_numconvenio=$propuesta->pp_numconvenio;
        $desarrollo->dp_fechaconvenio=$propuesta->pp_fechaconvenio;
        $desarrollo->dp_dir_usu_id=$propuesta->pp_dir_usu_id;
        $desarrollo->dp_pro_id=$propuesta->pp_pro_id;
        $desarrollo->dp_pp_id=$propuesta->pp_id;
        $desarrollo->save();

        return redirect()->route('estudiantes.index');
    }

    //redirige al formulario para editar la fase de desarrollo
    public function show(Request $request,$id){
        return $this->desarrolloEdit($request,$id);
    }
    public function desarrolloEdit(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        if($request->user()->propuesta != $id){
            return abort(401,'Página no autorizada');
        }
        $programas=Programas::all();
        $desarrollo=Desarrollo::find($id);
        $modalidades=Modalidades::all();
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        
        return view("estudiantes.editar", compact("desarrollo","usuarios","programas","modalidades"));
    }
    public function desarrolloPracticaEdit(Request $request, $id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        if($request->user()->practicas->dp_id != $id){
            return abort(401,'Página no autorizada');
        }
        $desarrollo=DesarrolloPractica::find($id);
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        
        return view("estudiantes.editarPractica", compact("desarrollo","usuarios"));
    }
    //actualizar datos en fase de desarrollo
    public function desarrolloUpdate(Request $request,$id){
        $desarrollo=Desarrollo::find($id);
        $this->validate($request,['prop_titulo'=>'required',
        'prop_dir_usu_id'=>'required']);

        if($request->hasFile('des_formato')){
            $file = $request->file('des_formato');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/desarrollo/',$name);
            unlink(public_path().'/files/desarrollo/'.$desarrollo->des_formato);
            $desarrollo->des_formato=$name;
        }
        $desarrollo->des_titulo=strtoupper($request->input('prop_titulo'));
        $desarrollo->des_dir_usu_id=$request->input('prop_dir_usu_id');
        $desarrollo->des_codir_usu_id=$request->input('prop_codir_usu_id');
        $desarrollo->des_pro_id=$request->input('des_pro_id');
        $desarrollo->des_mod_id=$request->input('des_mod_id');
        
        $desarrollo->save();
        return redirect()->route("estudiantes.index");
    }
    public function desarrolloPracticaUpdate(Request $request,$id){
        $desarrollo=DesarrolloPractica::find($id);
        $this->validate($request,['dp_titulo'=>'required',
        'dp_dir_usu_id'=>'required']);

        if($request->hasFile('dp_formato')){
            $file = $request->file('dp_formato');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/desarrollo/',$name);
            unlink(public_path().'/files/desarrollo/'.$desarrollo->des_formato);
            $desarrollo->dp_formato=$name;
        }
        
        $desarrollo->dp_titulo=strtoupper($request->input('dp_titulo'));
        $desarrollo->dp_dir_usu_id=$request->input('dp_dir_usu_id');
        $desarrollo->save();
        return redirect()->route("estudiantes.index");
    }
    //agrega estudiantes al trabajo de grado
    public function agregarEstudiante(Request $request){
        $user=User::where('documento',$request->input('documento'))->first();
        if(is_null($user)){
            return redirect()->route("estudiantes.index")->with('error','Estudiante no encontrado.');
        }
        if(isset($user->propuesta)){
            return redirect()->route("estudiantes.index")->with('error','El estudiante ya cuenta con una propuesta.');
        }
        $user->propuesta=$request->input('propuesta');
        $user->save();
        return redirect()->route("estudiantes.index");
    }
   //descarga el formato de la propuesta
    public function propuestaDownload(Request $request){
        $propuesta=Propuesta::find($request->user()->propuesta);
        $ruta=$propuesta->prop_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
        
    }
    public function propuestaPracticaDownload(Request $request,$id){
        $propuesta=PropuestaPractica::find($id);
        $ruta=$propuesta->pp_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
        
    }
    //descarga el formato de la fase de desarrollo
    public function desarrolloDownload(Request $request){
        $desarrollo=Desarrollo::where('des_prop_id',$request->user()->propuesta)->first();
        $ruta=$desarrollo->des_formato;
        return response()->download(public_path()."/files/desarrollo/$ruta");
        
    }
    public function desarrolloPracticaDownload(Request $request,$id){
        $desarrollo=DesarrolloPractica::where('dp_id',$id)->first();
        $ruta=$desarrollo->dp_formato;
        return response()->download(public_path()."/files/desarrollo/$ruta");
        
    }
    //sube el formato en la fase de desarrollo
    public function subirFormato(Request $request){
        if($request->hasFile('des_formato')){
            $file = $request->file('des_formato');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/desarrollo/',$name);
        }
        $desarrollo=Desarrollo::find($request->user()->propuesta)->first();
        $desarrollo->des_formato=$name;
        $desarrollo->save();
        return redirect()->route("estudiantes.index");
    }
    public function subirFormatoPractica(Request $request,$id){
        if($request->hasFile('dp_formato')){
            $file = $request->file('dp_formato');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/files/desarrollo/',$name);
        }
        $desarrollo=DesarrolloPractica::find($id)->first();
        $desarrollo->dp_formato=$name;
        $desarrollo->save();
        return redirect()->route("estudiantes.index");
    }
    //esta funcion permite a un estudiante salirse del trabajo de grado en el que esta registrado
    //cuando todos los estudiantes de un trabajo abandonan, se crea un registro de auditoria de su trabajo
    public function abandonar(Request $request){
        $desarrollo=Desarrollo::where('des_id',$request->user()->desarrollo)->first();
        $countu=User::all()->where('desarrollo',$request->user()->desarrollo);
        
        
        $ad_exist=Auditoria_desarrollo::find($request->user()->desarrollo);
        $id=$request->user()->propuesta;
        if(isset($desarrollo)){
            $novedad=new Novedades();
            $novedad->nov_des_id=$request->user()->propuesta;
            $novedad->nov_descripcion="El estudiante ".$request->user()->nombres." ".$request->user()->apellidos." con documento ".$request->user()->documento." abandono el trabajo.";
            $novedad->nov_fecha=date('Y-m-d');
            $novedad->save();
            $user=User::find($request->user()->id)->update(['desarrollo'=>NULL]);
        }
        
        if(count($countu)===1 && is_null($ad_exist)){
            $ad=new Auditoria_desarrollo();
            $ad->ad_id=$request->user()->propuesta;
            $ad->ad_titulo=$request->user()->propuestas->prop_titulo;
            $ad->ad_est1=$request->user()->id;
            $ad->ad_ap_id=$request->user()->propuesta;
            $ad->ad_dir_usu_id=$request->user()->propuestas->prop_dir_usu_id;
            $ad->ad_codir_usu_id=$request->user()->propuestas->prop_codir_usu_id;
            $ad->ad_mod_id=$request->user()->propuestas->prop_mod_id;
            $ad->ad_pro_id=$request->user()->propuestas->prop_pro_id;
            $ad->ad_con_id=$request->user()->propuestas->prop_con_id;
            $ad->ad_formato=$request->user()->propuestas->prop_formato;
            $ad->save();
            $nov=Novedades::all()->where('nov_des_id',$desarrollo->des_id);
            if(isset($nov)){
                foreach($nov as $n){
                    $an=new Auditoria_novedades();
                    $an->an_id=$n->nov_id;
                    $an->an_ad_id=$n->nov_des_id;
                    $an->an_descripcion=$n->nov_descripcion;
                    $an->an_fecha=$n->nov_fecha;
                    $an->save();
                }
                $nov=Novedades::where('nov_des_id',$desarrollo->des_id)->delete();
            }
            Desarrollo::find($id)->delete();
        }
        $vacio=User::all()->where('propuesta',$id);
        $ap_exist=Auditoria_propuesta::find($request->user()->propuesta);
        if(count($vacio)===1 && is_null($ap_exist)){
            $ap=new Auditoria_propuesta();
            $ap->ap_id=$request->user()->propuesta;
            $ap->ap_titulo=$request->user()->propuestas->prop_titulo;
            $ap->ap_est1=$request->user()->id;
            $ap->ap_dir_usu_id=$request->user()->propuestas->prop_dir_usu_id;
            $ap->ap_codir_usu_id=$request->user()->propuestas->prop_codir_usu_id;
            $ap->ap_mod_id=$request->user()->propuestas->prop_mod_id;
            $ap->ap_pro_id=$request->user()->propuestas->prop_pro_id;
            $ap->ap_con_id=$request->user()->propuestas->prop_con_id;
            $ap->ap_formato=$request->user()->propuestas->prop_formato;
            $ap->save();
            
        }
        $user=User::find($request->user()->id)->update(['propuesta'=>NULL]);
        $vacio=User::all()->where('propuesta',$id);
        if(count($vacio) === 0){
            Propuesta::find($id)->delete();
        }
        
        return redirect()->route("estudiantes.index");
    }
    //registrar una novedad digitada por el estudiante
    public function novedades(Request $request){
        $novedad=new Novedades();
        $novedad->nov_des_id=$request->user()->desarrollo;
        $novedad->nov_descripcion=$request->input('nov_descripcion');
        $novedad->nov_fecha=date('Y-m-d');
        $novedad->save();
        return redirect()->route("estudiantes.index");
    }
    public function novedadesPractica(Request $request,$id){
        $novedad=new Novedades_practicas();
        $novedad->np_dp_id=$id;
        $novedad->np_descripcion=$request->input('np_descripcion');
        $novedad->np_fecha=date('Y-m-d');
        $novedad->save();
        return redirect()->route("estudiantes.index");
    }

    public function finalizar(Request $request,$id){
        $desarrollo=Desarrollo::find($id);
        $ad=new Auditoria_desarrollo();

        $user=User::all()->where('desarrollo',$desarrollo->des_id);
        $cont=0;
        foreach($user as $u){
            $array[$cont]=$u->id;
            $cont++;
        }
        $ad->ad_id=$desarrollo->des_id;
        $ad->ad_titulo=$desarrollo->des_titulo;
        $ad->ad_est1=$array[0];
        if(isset($array[1])){
            $ad->ad_est2=$array[1];
        }
        if(isset($array[2])){
            $ad->ad_est3=$array[2];
        }
        $ad->ad_dir_usu_id=$desarrollo->des_dir_usu_id;
        $ad->ad_codir_usu_id=$desarrollo->des_codir_usu_id;
        $ad->ad_ap_id=$desarrollo->des_prop_id;
        $ad->ad_mod_id=$desarrollo->des_mod_id;
        $ad->ad_pro_id=$desarrollo->des_pro_id;
        $ad->ad_con_id=$desarrollo->des_con_id;
        $ad->ad_formato=$desarrollo->des_formato;
        $ad->save();
        $nov=Novedades::all()->where('nov_des_id',$id);
        if(isset($nov)){
            foreach($nov as $n){
                $an=new Auditoria_novedades();
                $an->an_id=$n->nov_id;
                $an->an_ad_id=$n->nov_des_id;
                 $an->an_descripcion=$n->nov_descripcion;
                $an->an_fecha=$n->nov_fecha;
            }
        }
        $nov=Novedades::where('nov_des_id',$id)->delete();
        $users=User::all()->where('desarrollo',$id);
        foreach($users as $u){
            $u->propuesta=NULL;
            $u->desarrollo=NULL;
            $u->save();
        }
        
        $desarrollo=Desarrollo::find($id)->delete();
        $propuesta=Propuesta::find($id)->delete();
        return redirect()->route('estudiantes.index')->with('success','Felicidades, Terminaste tu proceso de trabajo de grado.');
    }
}
