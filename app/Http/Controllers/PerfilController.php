<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Perfil;
use App\User;
use App\Conta;

class PerfilController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function edit() {
        $contas = Conta::all();

        return view('admin.perfil.edit', ['contas' => $contas]);
    }

    public function update(Request $request, $id){
        $dados = $request->only(['titular', 'numero', 'agencia']);

        $conta = Conta::find($id);
        $conta->titular = $dados['titular'];
        $conta->numero = $dados['numero'];
        $conta->agencia = $dados['agencia'];
        $conta->save();

        return redirect()->route('perfil.edit')
        ->with('warning', 'Conta '.$conta->banco.' atualizada com sucesso!');
    }

    public function editSenha() {
        return view('admin.perfil.edit-senha');
    }

    public function updateSenha(Request $request) {
        $password = $request->input('password');

        $user = User::find(1);
        $user->password = Hash::make($password);

        $user->save();

        return redirect()->route('perfil.editSenha')->with('warning', 'Senha atualizada com sucesso!');
        
    }
}
