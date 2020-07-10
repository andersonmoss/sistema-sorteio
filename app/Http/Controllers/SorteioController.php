<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sorteio;
use App\Aposta;
use App\Deposito;

class SorteioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $sorteios = Sorteio::all();

        return view('admin.sorteios.index', ['sorteios'=>$sorteios]);
    }


    public function create()
    {
        // $today = getdate();
        // $today = $today['mday']."-".$today['mon']."-".$today['year'];

        return view('admin.sorteios.create');
    }


    public function store(Request $request)
    {
        $sorteioNome = $request->input('name');
        
        $sorteioInicio = $request->input('begin_date');
        $sorteioFim = $request->input('final_date');
        $sorteioTexto = $request->input('descricao');


        $sorteio = new Sorteio();
        $sorteio->name = $sorteioNome;
        
        $sorteio->begin_date = $sorteioInicio;
        $sorteio->final_date = $sorteioFim;
        $sorteio->descricao = $sorteioTexto;

        $sorteio->save();

        return redirect()->route('sorteios.index');
    }


    public function show($id)
    {
        return redirect()->route('sorteios.index');
    }


    public function edit($id)
    {
        return view('admin.sorteios.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function delete($id)
    {
        $s = Sorteio::find($id);
        $s->delete();

        $apostasDoSorteio = Aposta::where('id_sorteio', $id)->delete();

        return redirect()->route('sorteios.index');
    }

    public function encerrar($id)
    {
        $s = Sorteio::find($id);

        $s->vigente = 0;
        $s->save();

        return redirect()->route('sorteios.index');
    }

    public function iniciar($id) {
        
        
        $sorteios = Sorteio::all();

        foreach($sorteios as $sorteio){
            $sorteio->vigente = 0;
            $sorteio->save();
        }

        $s = Sorteio::find($id);
        $s->vigente = 1;
        $s->save();

        return redirect()->route('sorteios.index');
    }

    public function conferir(){
        $sorteios = Sorteio::all();
        return view('admin.sorteios.conferir', ['sorteios'=>$sorteios]);
    }

    public function conferirAction(Request $request) {
        $sorteioId = $request->input('sorteio');
        $sorteio = Sorteio::find($sorteioId);
        $sorteio->vigente = 0;
        $sorteio->save();

        $numeroVencedor = $request->input('number');

        //Zerar apostas vencedoras no caso de mudar numero vencedor
        $vencedoresAntigos = Aposta::where('vencedora', '1')->where('id_sorteio', $sorteioId)->get();
        foreach($vencedoresAntigos as $v) {
            $v->vencedora = 0;
            $v->save();
        }
        //Fim do zeramento

        $vencedores = Aposta::where('status', '1')->where('numeros', $numeroVencedor)->where('id_sorteio', $sorteioId)->get();

        $apostasIlegais = array();
        $apostasVencedoras = array();

        foreach($vencedores as $vencedor) {
            $numeroRecibo = $vencedor->recibo;
            $deposito = Deposito::where('numero', $numeroRecibo)->get()->first();
            if(!$deposito == null) {
                $nivelDeposito = $deposito->nivel;
                
                $apostasComReciboEscolhido = Aposta::where('recibo', $numeroRecibo)->get();
                if(count($apostasComReciboEscolhido) > $nivelDeposito) {
                    $apostasIlegais[] = $vencedor;
                } else {
                    $vencedor->vencedora = 1;
                    $vencedor->save();

                    $apostasVencedoras[] = $vencedor;
                }
            }
            
        }



        $numeroVencedores = count($apostasVencedoras);

        return view('admin.sorteios.vencedores', [
            'apostasIlegais' => $apostasIlegais,
            'apostasVencedoras' => $apostasVencedoras,
            'numeroVencedores' => $numeroVencedores,
            'sorteio' => $sorteio
        ]);
    }
}
