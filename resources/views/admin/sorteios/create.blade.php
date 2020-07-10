{{-- ADMIN - AREA RESTRITA
<br><br>
<a href="{{route('logout')}}">Sair</a> --}}

@extends('adminlte::page')

@section('title', 'Painel Administrativo')

@section('content_header')
    <h1>Criação de sorteio</h1>
@endsection

@section('content')
  <div class="card card-primary card-outline">
    {{-- <div class="card-header">
      <h3 class="card-title">Todas os sorteios</h3>
    </div> --}}
    
    <div class="card-body">
      <form role="form" method="POST" action="{{route('sorteios.store')}}"> 
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="nome">Nome do sorteio</label>
            <input type="text" class="form-control" id="nome" name="name" placeholder="Ex: Sorteio de Páscoa">
          </div>
          
          <div class="form-group">
            <label for="begin_date">Início do sorteio</label>
            <input type="date" class="form-control" id="begin_date" name="begin_date" min="2020-01-01" max="2050-01-01" required>
          </div>
          <div class="form-group">
            <label for="final_date">Fim do sorteio</label>
            <input type="date" class="form-control" id="final_date" name="final_date" min="2020-01-01" max="2050-01-01">
          </div>
          <div class="form-group">
            <label>Texto do sorteio</label>
            <textarea class="form-control" rows="10" placeholder="Digite aqui o texto da página inicial do sorteio" name="descricao"></textarea>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Criar Sorteio</button>
        </div>
      </form>
    </div>
  </div>

@endsection