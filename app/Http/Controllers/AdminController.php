<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aposta;
use App\Sorteio;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $apostas = Aposta::paginate(5);

        //Valores padrão
        $totalDeApostas = 0;
        $apostasPendentes = 0;
        $apostasConfirmadas = 0;
        $totalSorteios = 0;

        //Atualiza valores
        
        $totalDeApostas = count(Aposta::all());
        $apostasConfirmadas = count(Aposta::where('status', 1)->get());
        $apostasPendentes = count(Aposta::where('status', 0)->get());
        $totalSorteios = count(Sorteio::all());

        $dados['totalDeApostas'] = $totalDeApostas;
        $dados['apostasConfirmadas'] = $apostasConfirmadas;
        $dados['apostasPendentes'] = $apostasPendentes;
        $dados['totalSorteios'] = $totalSorteios;

        return view('admin.index', ['apostas' => $apostas, 'dados'=>$dados]);
    }
}
