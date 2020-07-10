@extends('adminlte::page')

@section('content')
<section class="container mt-5">
<h1 class="h2 text-center mb-5">Insira o número da aposta</h1>
<form class="mx-auto" style="max-width: 400px;" method="post">
    @csrf
    <div class="form-group">
    <label for="aposta">Números da aposta ou email do apostador</label>
    <input type="text" class="form-control" id="aposta" name="aposta" required>
    {{-- <small id="email" class="form-text text-muted">Você deve inserir o endereço o email utilizado na aposta</small> --}}
    </div>
    
    
    <button type="submit" class="btn btn-primary">Buscar aposta</button>

</form>
</section>
<section class="container mb-3">
  <hr class="mt-5 mb-0">
  <div class="row">
    @if(session('warning'))
    <h2 class="mx-auto col-md-8 text-center mt-5">{{session('warning')}}</h2>
    @endif

    @if(isset($apostas))
    @if(count($apostas)>0)
    <div class="card card-primary col-sm-10 mx-auto mt-5 w-100">
      {{-- <div class="card-header">
        <h3 class="card-title">Depósito encontrado:</h3>
      </div> --}}
      <h2 class="text-center my-3">Aposta(s) encontrada(s)</h2>
      <hr>
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
                  <td><a style="max-width: 100px" type="button" class="btn btn-block text-white btn-success">Aprovada</a></td>
                @else
                  <td><a style="max-width: 100px" type="button" class="btn btn-block text-white btn-danger">Pendente</a></td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
    @endif
  </div>
</section>
    
@endsection