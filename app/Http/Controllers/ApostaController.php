<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use App\Aposta;
use App\Sorteio;
use App\Deposito;

class ApostaController extends Controller
{
    public function todasApostas(Request $request){
        $todasApostas = Aposta::paginate(5);
        $sorteios = Sorteio::all();
        $sorteioSelecionado = null;

        if($request->query('sorteio')) {
            $sorteio = $request->query('sorteio');
            // Verificar se torneio existe
            $s = Sorteio::find(intval($sorteio));
            
            if(!$s) return redirect()->route('apostas.all');
            $sorteioSelecionado = $s;
            //Filtrar
            $todasApostas = Aposta::where('id_sorteio', $sorteio)->paginate(5);
        }

        return view('admin.apostas.todas-apostas', ['apostas' => $todasApostas, 'sorteios'=>$sorteios, 'sorteioSelecionado'=>$sorteioSelecionado]);
    }
    public function apostasPendentes(Request $request){
        
        $apostasPendentes = Aposta::where('status', 0)->paginate(5);
        $sorteios = Sorteio::all();
        $sorteioSelecionado = null;

        if($request->query('sorteio')) {
            $sorteio = $request->query('sorteio');
            // Verificar se torneio existe
            $s = Sorteio::find(intval($sorteio));
            
            if(!$s) return redirect()->route('apostas.all');
            $sorteioSelecionado = $s;
            //Filtrar
            $apostasPendentes = Aposta::where('status', 0)->where('id_sorteio', $sorteio)->paginate(5);
        }

        return view('admin.apostas.apostas-pendentes', ['apostas' => $apostasPendentes, 'sorteios'=>$sorteios, 'sorteioSelecionado'=>$sorteioSelecionado]);
    }
    public function apostasConfirmadas(Request $request){
        
        $apostasConfirmadas = Aposta::where('status', 1)->paginate(5);
        $sorteios = Sorteio::all();
        $sorteioSelecionado = null;

        if($request->query('sorteio')) {
            $sorteio = $request->query('sorteio');
            // Verificar se torneio existe
            $s = Sorteio::find(intval($sorteio));
            
            if(!$s) return redirect()->route('apostas.all');
            $sorteioSelecionado = $s;
            //Filtrar
            $apostasConfirmadas = Aposta::where('status', 0)->where('id_sorteio', $sorteio)->paginate(5);
        }

        return view('admin.apostas.apostas-confirmadas', ['apostas' => $apostasConfirmadas, 'sorteios'=>$sorteios, 'sorteioSelecionado'=>$sorteioSelecionado]);
    }

    public function registrarAposta($plano){
        $sorteioVigente = Sorteio::where('vigente', 1)->get();
        $existeSorteioVigente = count($sorteioVigente);

        if(!$existeSorteioVigente) return redirect()->route('welcome');

        $faixa_planos = [1,2,3,4];

        if(!in_array($plano, $faixa_planos)) {
            return redirect()->route('welcome');
            exit;
        }

        

        if($plano==1) $planoNome = "Vip";
        if($plano==2) $planoNome = "Silver";
        if($plano==3) $planoNome = "Gold";
        if($plano==4) $planoNome = "Platinum";

        return view('front.apostas.registrar-aposta', [
            'plano'=>$plano,
            'planoNome'=>$planoNome
        ]);
    }

    public function registrarApostaAction(Request $request){
        $nome = $request->input('nome');
        $email = $request->input('email');
        $telefone = $request->input('telefone');
        $numero_comprovante = $request->input('numero_comprovante');
        $numeros_aposta = $request->input('numeros_aposta');
        
        if (count($numeros_aposta) > 4) {
            echo 'numero de apostas nao pode ser maior que 4';
            exit;
        }

        $apostaExiste = Aposta::where('recibo', $numero_comprovante)->get();

        if(count($apostaExiste) > 0) {
            return view('front.apostas.aposta-erro',['warning'=>'Comprovante já utilizado!']);
        }

        $comprovanteExiste = Deposito::where('numero', $numero_comprovante)->get();
        if(count($comprovanteExiste) > 0) {
            return view('front.apostas.aposta-erro',['warning'=>'Comprovante já utilizado!']);
        }

        $sorteioVigente = Sorteio::where('vigente', 1)->get()->first();


        for ($i=0; $i < count($numeros_aposta); $i++) { 
            $aposta = new Aposta;
            $aposta->nome = $nome;
            $aposta->email = $email;
            $aposta->telefone = $telefone;
            $aposta->recibo = $numero_comprovante;
            $aposta->numeros = $numeros_aposta[$i];
            $aposta->id_sorteio = $sorteioVigente->id;
            $aposta->save();
        }

        $deposito = new Deposito;
        $deposito->email = $email;
        $deposito->numero = $numero_comprovante;

        if($request->input('banco') == 1){
            $deposito->banco = "BB";
        }
        if($request->input('banco') == 2){
            $deposito->banco = "Bradesco";
        }   
        if($request->input('banco') == 3){
            $deposito->banco = "Itau";
        }   
        if($request->input('banco') == 4){
            $deposito->banco = "Santander";
        }   

        
        $deposito->nivel = count($numeros_aposta);
        $deposito->save();

        return view('front.apostas.aposta-realizada', ['aposta'=>$aposta]);
    }

    
    public function verificarAposta(){
        return view('front.apostas.verificar-aposta');
    }

    public function verificarApostaAction(Request $request){
        if(empty($request->input('email'))) return redirect()-route('welcome');

        $email = $request->input('email');
        $apostas = Aposta::where('email', $email)->get();


        return view('front.apostas.apostas-encontradas',[
            'email' => $email,
            'apostas' => $apostas
        ]);
    }

    public function aprovar($id){
        $aposta = Aposta::find($id);

        $numeroDepositoAposta = $aposta->recibo;

        $depositoDaAposta = Deposito::where('numero', $numeroDepositoAposta)->get()->first();
        $depositoDaAposta->status = 1;
        $depositoDaAposta->save();

        $apostasIrmas = Aposta::where('recibo', $numeroDepositoAposta)->get();
        
        foreach($apostasIrmas as $a) {
            $a->status = 1;
            $a->save();
        }

        
        return back();
    }
    public function reprovar($id){
        $aposta = Aposta::find($id);

        $numeroDepositoAposta = $aposta->recibo;

        $depositoDaAposta = Deposito::where('numero', $numeroDepositoAposta)->get()->first();
        $depositoDaAposta->status = 0;
        $depositoDaAposta->save();

        $apostasIrmas = Aposta::where('recibo', $numeroDepositoAposta)->get();
       
        foreach($apostasIrmas as $a) {
            $a->status = 0;
            $a->save();
        }

        return back();
    }

    public function search(){
        return view('admin.apostas.search');
    }
    public function result(Request $request){
        $apostas = Aposta::where('numeros', $request->input('aposta'))->orWhere('email', $request->input('aposta'))->get();

        if(count($apostas) == 0){
            return back()->with('warning', 'Nenhuma aposta encontrada!');
        }

        return view('admin.apostas.search', ['apostas'=>$apostas]);
    }
}
