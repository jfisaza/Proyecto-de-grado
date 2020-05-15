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

    public function create(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('estudiante');
        $usuarios=DB::table('users')->join('roles_user', 'users.id','=','roles_user.user_id')->select('users.id','users.nombres','users.apellidos')->where('roles_user.roles_rol_id','2')->get();
        $modalidades=Modalidades::all();
        return view("estudiantes.create", compact("usuarios","modalidades"));
    }

    

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

    public function crearDesarrollo(Request $request){
        $desarrollo=new Desarrollo();
        $desarrollo->des_id=$request->user()->propuesta;
        $desarrollo->des_prop_id=$request->user()->propuesta;
        $desarrollo->save();
        return redirect()->route("estudiantes.index");
    }

    public function enlazarPropuestaUser(Request $request, $pro){
        $propuesta=Propuesta::where('prop_titulo',$pro->prop_titulo)->first();
        $userid=$request->user()->id;
        $user=User::find($userid);
        $user->propuesta=$propuesta->prop_id;
        $user->save();
        return redirect()->route("estudiantes.index");
    }
    public function agregarEstudiante(Request $request){
        $user=User::where('documento',$request->input('documento'))->first();
        if(is_null($user)){
            return redirect()->route("estudiantes.index")->with('error','Estudiante no encontrado.');
        }
        $user->propuesta=$request->input('propuesta');
        $user->save();
        return redirect()->route("estudiantes.index");
    }
   
    public function propuestaDownload(Request $request){
        $propuesta=Propuesta::find($request->user()->propuesta);
        $ruta=$propuesta->prop_formato;
        return response()->download(public_path()."/files/propuesta/$ruta");
        
    }
    public function desarrolloDownload(Request $request){
        $desarrollo=Desarrollo::where('des_prop_id',$request->user()->propuesta)->first();
        $ruta=$desarrollo->des_formato;
        return response()->download(public_path()."/files/final/$ruta");
        
    }
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

    public function abandonar(Request $request){
        $desarrollo=Desarrollo::where('des_prop_id',$request->user()->propuesta)->first();
        if(isset($desarrollo)){
            $novedad=new Novedades();
            $novedad->nov_des_id=$request->user()->propuesta;
            $novedad->nov_descripcion="El estudiante ".$request->user()->nombres." ".$request->user()->apellidos." con documento ".$request->user()->documento." abandono el trabajo.";
            $novedad->nov_fecha=date('Y-m-d');
            $novedad->save();
        }
        $user=DB::table('users')->where('id',$request->user()->id)->update(['propuesta'=>NULL]);
        return redirect()->route("estudiantes.index");
    }
}
