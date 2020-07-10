<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposito;
use App\Aposta;

class DepositoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index() {
        $depositos = Deposito::paginate(5);
        
        return view('admin.depositos.index', ['depositos'=>$depositos]);
    }

    public function confirmar($id, $search = false) {
        
        $deposito = Deposito::find($id);
        $deposito->status = 1;
        $deposito->save();

        $apostasIrmas = Aposta::where('recibo', $deposito->numero)->get();
        foreach($apostasIrmas as $a) {
            $a->status = 1;
            $a->save();
        }

        if($search) {
            return redirect()->route('depositos.search')->with('warning','Depósito aprovado com sucesso!');
        }

        return back();
    }
    public function reprovar($id, $search = false) {
        $deposito = Deposito::find($id);
        $deposito->status = 0;
        $deposito->save();

        $apostasIrmas = Aposta::where('recibo', $deposito->numero)->get();
        foreach($apostasIrmas as $a) {
            $a->status = 0;
            $a->save();
        }

        if($search) {
            return redirect()->route('depositos.search')->with('warning','Depósito desconfirmado com sucesso!');
        }

        return back();
    }
    public function search(){
        return view('admin.depositos.search');
    }
    public function result(Request $request){
        $deposito = Deposito::where('numero', $request->input('deposito'))->first();

        if(!$deposito){
            
            return view('admin.depositos.search', ['warning'=>'Depósito não encontrado!'])->with('warning', 'Depósito não encontrado!');
        }

        return view('admin.depositos.search', ['deposito'=>$deposito]);
    }

    public function numero($id) {
        $deposito = Deposito::find($id);
        if(!$deposito) {
            return redirect()->route('depositos.index');
        }

        return view('admin.depositos.numero', ['deposito'=>$deposito]);
    }

    public function putnumero(Request $request, $id){
        $deposito = Deposito::find($id);
        if(!$deposito) {
            return redirect()->route('depositos.index');
        }
        $numeros = Deposito::where('numero', $request->numero)->get();
        if(count($numeros) > 0) {
            return redirect()->route('depositos.numero', ['id'=>$id])->with('utilizado', 'Comprovante já utilizado!');
        }
        
        $apostas = Aposta::where('recibo', $deposito->numero)->get();
        foreach($apostas as $aposta) {
            $aposta->recibo = $request->numero;
            $aposta->save();
        }
        
        $deposito->numero = $request->input('numero');
        $deposito->save();
        return redirect()->route('depositos.numero', ['id'=>$id])->with('warning', 'Número alterado com sucesso!');
    }

    public function date($id) {
        $deposito = Deposito::find($id);
        if(!$deposito) {
            return redirect()->route('depositos.index');
        }

        return view('admin.depositos.date', ['deposito'=>$deposito]);
    }

    public function putdate(Request $request, $id){
        $deposito = Deposito::find($id);
        if(!$deposito) {
            return redirect()->route('depositos.index');
        }

        $deposito->data = $request->input('data');
        $deposito->save();
        return redirect()->route('depositos.date', ['id'=>$id])->with('warning', 'Data alterada com sucesso!');
    }
}
