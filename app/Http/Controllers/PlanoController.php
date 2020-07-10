<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plano;
use App\Beneficio;

class PlanoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function edit(){
        $planos = Plano::all();
        $planosComBeneficios = [];

        foreach($planos as $plano) {
            $beneficios = Beneficio::where('id_plano', $plano->id)->get();
            
            $planosComBeneficios[$plano->id] = $beneficios;
        }

        return view('admin.planos.edit', ['planos'=>$planos, 'planosComBeneficios'=>$planosComBeneficios]);
    }

    public function insert(Request $request, $id){
        $beneficio = new Beneficio;
        $beneficio->texto = $request->input('beneficio');
        $beneficio->id_plano = $id;
        $beneficio->save();
        return back();
    }

    public function delete($id){
        $beneficio = Beneficio::find($id);
        $beneficio->delete();
        return back();
    }
}
