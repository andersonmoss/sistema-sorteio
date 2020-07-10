@extends('adminlte::page')

@section('title', 'Painel Administrativo')

@section('content_header')
    
@endsection

@section('content')
  <form method="GET">
    <div class="form-group">
      <label>Filtrar por sorteio:</label><br>
    
    <select name="sorteio">
      <option value="">Todos os sorteios</option>
      @foreach ($sorteios as $sorteio)
        <option value="{{$sorteio->id}}">{{$sorteio->name}}</option>  
      @endforeach
      
      
    </select>
    <input type="submit" value="Filtrar">
    </div>
  </form>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Apostas Pendentes @if($sorteioSelecionado) (do sorteio: {{$sorteioSelecionado->name}}) @endif</h3>
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
                <td><a style="max-width: 100px" href="{{route('apostas.reprovar', ['id'=>$aposta->id])}}" type="button" class="btn btn-block btn-outline-success">Aprovada</a></td>
              @else
                <td><a style="max-width: 100px" href="{{route('apostas.aprovar', ['id'=>$aposta->id])}}" type="button" class="btn btn-block btn-outline-danger">Pendente</a></td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      
      {{$apostas->appends(request()->query())->links()}}
      
    </div>
  </div>

@endsection