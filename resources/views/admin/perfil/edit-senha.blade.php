@extends('adminlte::page')

@section('title', 'Painel Administrativo')

@section('content_header')
  @if(session('warning'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-check"></i> Confirmado!</h5>
      {{session('warning')}}
    </div>
  @endif
  <h1>Edição de Senha</h1>
@endsection

@section('content')
  <div class="card card-primary card-outline">
    {{-- <div class="card-header">
      <h3 class="card-title">Todas os sorteios</h3>
    </div> --}}

    <div class="card-body">
      <form role="form" method="POST"> 
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="senha">Nova senha</label>
            <input type="password" class="form-control" id="senha" name="password" required>
          </div>
          
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
@endsection