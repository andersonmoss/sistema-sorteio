{{-- ADMIN - AREA RESTRITA
<br><br>
<a href="{{route('logout')}}">Sair</a> --}}

@extends('adminlte::page')

@section('title', 'Painel Administrativo')

@section('content_header')
    <h1>Gerenciamento de depositos</h1>
@endsection

@section('content')
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Todos os depositos</h3>
    </div>
    
    <div class="card-body table-responsive p-0">
      <table class="table table-hover">
        <thead>
          <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Numero</th>
          <th>Valor</th>
          <th>Banco</th>
          <th>Data</th>
          <th>Ação</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($depositos as $deposito)
          <tr>
              <td>{{$deposito->id}}</td>
              <td>{{$deposito->email}}</td>
              <td><a href="{{route('depositos.numero', ['id'=>$deposito->id])}}">{{$deposito->numero}}</a></td>
              
              @if($deposito->nivel == 1)
              <td>R$10,00</td>
              @elseif($deposito->nivel == 2)
              <td>R$20,00</td>
              @elseif($deposito->nivel == 3)
              <td>R$30,00</td>
              @elseif($deposito->nivel == 4)
              <td>R$40,00</td>
              @else
              <td>Sem valor</td>
              @endif

              <td>{{$deposito->banco}}</td>
              <td>
                @if($deposito->data === null)
                <a href="{{route('depositos.date', ['id'=>$deposito->id])}}"> INSERIR</a>
                @else
                <a href="{{route('depositos.date', ['id'=>$deposito->id])}}"> {{date('d-m-Y', strtotime($deposito->data))}}</a>
                @endif
              </td>
              <td>
                
                @if($deposito->status)
                  <a style="max-width: 100px" href="{{route('deposito.reprovar', ['id'=>$deposito->id])}}" type="button" class="btn btn-sm  btn-success">Confirmado</a>
                @else
                  <a style="max-width: 100px" href="{{route('deposito.confirmar', ['id'=>$deposito->id])}}" type="button" class="btn btn-sm  btn-primary">Confirmar</a>
                @endif

              </td>
          </tr>
        @endforeach
          
        </tbody>
      </table>
      <div class="card-footer">
        
          {{$depositos->links()}}
        
      </div>
    </div>
  </div>

@endsection