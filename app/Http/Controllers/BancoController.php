<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banco;
use App\Programas;
use App\Solicitudes;

class BancoController extends Controller
{
    public function index(Request $request){
        $banco=Banco::programas($request->get('ban_pro_id'))->paginate();
        $solicitud=Solicitudes::programas($request->get('ban_pro_id'))->paginate();
        $programa=Programas::all();
        return view("banco_ideas.index", compact("banco","solicitud","programa"));
    }
    public function create(){
        
    }
    public function edit($id){
        
    }
    public function destroy($id){
        
    }
}
