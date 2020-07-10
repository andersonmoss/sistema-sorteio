{{-- ADMIN - AREA RESTRITA
<br><br>
<a href="{{route('logout')}}">Sair</a> --}}

@extends('adminlte::page')

@section('title', 'Painel Administrativo')


@section('content')
  
  <div class="card card-primary">
    <h2 class="text-center my-3">Alteração de número</h2>
      <hr>

    <h3 class="px-3">Depósito número: {{$deposito->numero}}</h3>
    <div class="card-body table-responsive p-4">
      <form action="{{route('depositos.putnumero', ['id'=>$deposito->id])}}" method="POST">
        @csrf
        <div class="form-group">
          <label>Novo número:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i></span>
            </div>
            <input type="number" max="99999999999999999" required name="numero">
          </div>
        </div>
        

        <input class="btn btn btn-danger" type="submit" value="Salvar">
      </form>
      <hr>
      <h5>Outras opções:</h5>
      <form class="d-inline" action="{{route('depositos.result')}}" method="POST">
        @csrf
        <input type="hidden" name="deposito" value="{{$deposito->numero}}">
        <input class="btn btn-success btn-sm" type="submit" value="Visualizar depósito">
      </form>
      
      <a class="btn btn-info btn-sm" href="{{route('depositos.search')}}">Pesquisar depósito</a>

    </div>
  </div>
  @if(session('warning'))
  {{-- <h2 class="mx-auto col-md-8 text-center mt-5">{{session('warning')}}</h2> --}}
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Salvo!</h5>
    {{session('warning')}}
  </div>
  @endif
  @if(session('utilizado'))
  {{-- <h2 class="mx-auto col-md-8 text-center mt-5">{{session('utilizado')}}</h2> --}}
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Erro!</h5>
    {{session('utilizado')}}
  </div>
  @endif
@endsection