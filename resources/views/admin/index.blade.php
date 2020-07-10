{{-- ADMIN - AREA RESTRITA
<br><br>
<a href="{{route('logout')}}">Sair</a> --}}

@extends('adminlte::page')

@section('title', 'Painel Administrativo')

@section('content_header')
    <h1>Informações gerais</h1>
@endsection

@section('content')
    
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{$dados['totalDeApostas']}}</h3>

        <p>Total de apostas</p>
      </div>
      <div class="icon">
        <i class="fas fa-chart-pie"></i>
      </div>
      <a href="{{route('apostas.all')}}" class="small-box-footer">
        Mais informações <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$dados['apostasConfirmadas']}}</h3>

        <p>Apostas Confirmadas</p>
      </div>
      <div class="icon">
        <i class="fas fa-user"></i>
      </div>
      <a href="{{route('apostas.confirmadas')}}" class="small-box-footer">
        Mais informações <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$dados['apostasPendentes']}}</h3>

        <p>Apostas Pendentes</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-plus"></i>
      </div>
      <a href="{{route('apostas.pendentes')}}" class="small-box-footer">
        Mais informações <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$dados['totalSorteios']}}</h3>

        <p>Sorteios</p>
      </div>
      <div class="icon">
        <i class="fas fa-star"></i>
      </div>
      <a href="{{route('sorteios.index')}}" class="small-box-footer">
        Mais informações <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
</div>

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Todas as apostas</h3>
    </div>
    
    <div class="card-body table-responsive p-0">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Numeros</th>
            <th>Deposito</th>
            <th>Confirmação</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($apostas as $aposta)
            <tr>
              <td>{{$aposta->id}}</td>
              <td>{{$aposta->nome}}</td>
              <td>{{$aposta->email}}</td>
              <td>{{$aposta->numeros}}</td>
              <td>{{$aposta->recibo}}</td>
              @if($aposta->status)
                <td><a style="max-width: 100px" href="#" type="button" class="btn btn-block btn-outline-success">Aprovada</a></td>
              @else
                <td><a style="max-width: 100px" href="#" type="button" class="btn btn-block btn-outline-danger">Pendente</a></td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
      
    </div>
    <div class="card-footer">
      {{$apostas->links()}}
    </div>
  </div>

@endsection