<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sorteio;

class HomeController extends Controller
{
    public function index() {
        $sorteioVigente = Sorteio::where('vigente', 1)->get();
        $existeSorteioVigente = count($sorteioVigente);

        if($existeSorteioVigente) {
            $sorteioVigente = $sorteioVigente->first();
        }

        return view('welcome', ['sorteio'=>$sorteioVigente, 'existeSorteioVigente'=>$existeSorteioVigente]);
    }
}
