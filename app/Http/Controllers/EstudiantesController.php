<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Modalidades;
use App\Propuesta;
use App\Desarrollo;
use App\Novedades;

class EstudiantesController extends Controller
{
    //redirige a la pagina principal del proceso de trabajo de grado para el estudiante
    public function index(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        $estudiantes=User::all()->where('propuesta',$request->user()->propuesta);
        $desarrollo=Desarrollo::all()->where('des_prop_id',$request->user()->propuesta);
        $novedades=Novedades::all()->where('nov_des_id',$request->user()->propuesta);
        return view("estudiantes.index", compact("estudiantes","desarrollo","novedades"));
    }
    //redirige al formulario para crear una propuesta
    public function create(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        $modalidades=Modalidades::all();
        return view("estudiantes.create", compact("usuarios","modalidades"));
    }
<<<<<<< HEAD


=======
    //crea la propuesta
>>>>>>> 1cf002d53f82aacec6a2232d85e9dfaebd401e57
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
        $propuesta->prop_titulo=$request->input('prop_titulo');
        $propuesta->prop_dir_usu_id=$request->input('prop_dir_usu_id');
        $propuesta->prop_codir_usu_id=$request->input('prop_codir_usu_id');
        $propuesta->prop_mod_id=$request->input('prop_mod_id');
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
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        return view("estudiantes.edit", compact("propuesta","usuarios"));
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

        $propuesta->prop_titulo=$request->input('prop_titulo');
        $propuesta->prop_dir_usu_id=$request->input('prop_dir_usu_id');
        $propuesta->prop_codir_usu_id=$request->input('prop_codir_usu_id');
        $propuesta->save();
        return redirect()->route("estudiantes.index");
    }
    //enlaza la propuesta acabada de registrar con el estudiante que la registro
    public function enlazarPropuestaUser(Request $request, $pro){
        $propuesta=Propuesta::where('prop_titulo',$pro->prop_titulo)->first();
        $userid=$request->user()->id;
        $user=User::find($userid);
        $user->propuesta=$propuesta->prop_id;
        $user->save();
        return redirect()->route("estudiantes.index");
    }
    //crea el registro en la tabla desarrollo
    public function crearDesarrollo(Request $request){
        
        $desarrollo=new Desarrollo();
        $desarrollo->des_id=$request->user()->propuesta;
        $desarrollo->des_prop_id=$request->user()->propuesta;
        $desarrollo->save();
        
        return redirect()->route("estudiantes.index");
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
        $desarrollo=Desarrollo::find($id);
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        
        return view("estudiantes.editar", compact("desarrollo","usuarios"));
    }
    public function desarrolloUpdate(Request $request,$id){
        $propuesta=Propuesta::find($id);
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
        $propuesta->prop_titulo=$request->input('prop_titulo');
        $propuesta->prop_dir_usu_id=$request->input('prop_dir_usu_id');
        $propuesta->prop_codir_usu_id=$request->input('prop_codir_usu_id');
        
        $propuesta->save();
        $desarrollo->save();
        return redirect()->route("estudiantes.index");
    }
    //agrega estudiantes al trabajo de grado
    public function agregarEstudiante(Request $request){
        $user=User::where('documento',$request->input('documento'))->first();
        if(is_null($user)){
            return redirect()->route("estudiantes.index")->with('error','Estudiante no encontrado.');
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
    //descarga el formato de la fase de desarrollo
    public function desarrolloDownload(Request $request){
        $desarrollo=Desarrollo::where('des_prop_id',$request->user()->propuesta)->first();
        $ruta=$desarrollo->des_formato;
        return response()->download(public_path()."/files/final/$ruta");
        
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
    //esta funcion permite a un estudiante salirse del trabajo de grado en el que esta registrado
    public function abandonar(Request $request){
        $desarrollo=Desarrollo::where('des_prop_id',$request->user()->propuesta)->first();
        if(isset($desarrollo)){
            $novedad=new Novedades();
            $novedad->nov_des_id=$request->user()->propuesta;
            $novedad->nov_descripcion="El estudiante ".$request->user()->nombres." ".$request->user()->apellidos." con documento ".$request->user()->documento." abandono el trabajo.";
            $novedad->nov_fecha=date('Y-m-d');
            $novedad->save();
        }
        $id=$request->user()->propuesta;
        $user=DB::table('users')->where('id',$request->user()->id)->update(['propuesta'=>NULL]);
        $vacio=User::all()->where('propuesta',$id);
        if(count($vacio)===0){
            if(isset($desarrollo)){
                $novedades=Novedades::all()->where('nov_des_id',$id);
                if(count($novedades) != 0){
                    Novedades::where('nov_des_id',$id)->delete();
                }
                Desarrollo::find($id)->delete();
            }
            Propuesta::find($id)->delete();
        }
        return redirect()->route("estudiantes.index");
    }
    public function novedades(Request $request){
        $novedad=new Novedades();
        $novedad->nov_des_id=$request->user()->propuesta;
        $novedad->nov_descripcion=$request->input('nov_descripcion');
        $novedad->nov_fecha=date('Y-m-d');
        $novedad->save();
        return redirect()->route("estudiantes.index");
    }
}
