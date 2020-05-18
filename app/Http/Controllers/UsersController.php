<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Programas;

class UsersController extends Controller
{
    public function edit(Request $request,$id){
        if(empty($request->user())){
            return view("auth.login");
        }
        $user=User::find($id);
        if($user->id != $request->user()->id){
            return abort(401,'Pagina no autorizada');
        }
        $programas=Programas::all();
        return view('users.edit',compact('user','programas'));
    }
    protected function update(Request $request,$id)
    {
        $this->validate($request,['documento'=>'required',
        'nombres'=>'required','apellidos'=>'required', 'telefono'=>'required',
        'ciudad'=>'required','programa'=>'required']);
        User::find($id)->update($request->all());
        // $user->documento=$request->input('documento');
        // $user->nombres=$request->input('nombres');
        // $user->apellidos=$request->input('apellidos');
        // $user->telefono=$request->input('telefono');
        // $user->ciudad=$request->input('ciudad');
        // $user->programa=$request->input('programa');
        // $user->update();
        
        return redirect()->route("home");

    }
}
