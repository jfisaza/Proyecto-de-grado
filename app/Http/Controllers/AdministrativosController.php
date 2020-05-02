<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrativosController extends Controller
{
    public function index(Request $request){
        if(empty($request->user())){
            return view("auth.login");
        }
        $request->user()->authorizeRoles('administrativo');
        return view("administrativos.index");
    }
}
