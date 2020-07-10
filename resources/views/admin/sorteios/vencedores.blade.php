{{-- ADMIN - AREA RESTRITA
<br><br>
<a href="{{route('logout')}}">Sair</a> --}}

@extends('adminlte::page')

@section('title', 'Painel Administrativo')

@section('content_header')
    <h1>Apostas Vencedoras: {{$sorteio->name}}</h1>
@endsection

@section('content')
  <div class="card card-primary card-outline">
    {{-- <div class="card-header">
      <h3 class="card-title">Todas os sorteios</h3>
    </div> --}}
    
    <div class="card-body">
      @if($numeroVencedores == 0)
        <h2>Não há apostas vencedoras para esse sorteio</h2>
      @else
        <h2>Esse sorteio possui {{$numeroVencedores}} apostas vencedoras</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Numeros</th>
              <th scope="col">Telefone</th>
              
            </tr>
          </thead>
          <tbody>
              
              @foreach ($apostasVencedoras as $apostaVencedora)
                  <tr>
                      
                      <td>{{$apostaVencedora->nome}}</td>
                      <td>{{$apostaVencedora->email}}</td>
                      <td>{{$apostaVencedora->numeros}}</td>
                      <td>{{$apostaVencedora->telefone}}</td>
                      
                  </tr>
              @endforeach
          </tbody>
        </table>
      @endif
      @if(count($apostasIlegais) > 0)
        <h2>Porém as seguintes apostas foram invalidadas</h2>
        <p>Motivo: Jogador apostou numa categoria acima do seu plano</p>

        <table class="table table-striped">
          <thead>
            <tr>
              
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Numeros</th>
              <th scope="col">Telefone</th>
              
            </tr>
          </thead>
          <tbody>
              @foreach ($apostasIlegais as $apostaIlegal)
                  <tr>
                      
                      <td>{{$apostaIlegal->nome}}</td>
                      <td>{{$apostaIlegal->email}}</td>
                      <td>{{$apostaIlegal->numeros}}</td>
                      <td>{{$apostaIlegal->telefone}}</td>
                      
                  </tr>
              @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>

@endsection