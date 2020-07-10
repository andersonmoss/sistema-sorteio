{{-- ADMIN - AREA RESTRITA
<br><br>
<a href="{{route('logout')}}">Sair</a> --}}

@extends('adminlte::page')

@section('title', 'Painel Administrativo')

@section('content_header')
    <h1>Gerenciamento de sorteios</h1>
@endsection

@section('content')
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Todos os sorteios</h3>
    </div>
    
    <div class="card-body table-responsive p-0">
      <table class="table table-hover">
        <thead>
          <tr>
          <th>ID</th>
          <th>Nome</th>
          
          <th>Inicio</th>
          <th>Fim</th>
          <th>Ação</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($sorteios as $sorteio)
          <tr>
              <td>{{$sorteio->id}}</td>
              <td>{{$sorteio->name}}</td>
              
              <td>{{date("d/m/Y", strtotime($sorteio->begin_date))}}</td>
              <td>{{date("d/m/Y", strtotime($sorteio->final_date))}}</td>
              <td>
                
                @if(!$sorteio->vigente)
                  <a style="max-width: 100px" href="{{route('sorteios.iniciar', ['id'=>$sorteio->id])}}" type="button" class="btn btn-sm  btn-success">Iniciar</a>
                  <a style="max-width: 100px" href="{{route('sorteios.delete', ['id'=>$sorteio->id])}}" type="button" class="btn btn-sm  btn-danger">Excluir</a>
                @else
                  <a style="max-width: 100px" href="{{route('sorteios.encerrar', ['id'=>$sorteio->id])}}" type="button" class="btn btn-sm  btn-primary">Encerrar</a>
                @endif

              </td>
          </tr>
        @endforeach
          
        </tbody>
      </table>
      <div class="card-footer">
        @if(isset($sorteios->links))
          {{$sorteios->links()}}
        @endif
      </div>
    </div>
  </div>

@endsection