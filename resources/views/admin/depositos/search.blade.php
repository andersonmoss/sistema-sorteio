@extends('adminlte::page')

@section('content')
<section class="container mt-5">
<h1 class="h2 text-center mb-5">Insira o número do depósito</h1>

<form class="mx-auto" style="max-width: 400px;" method="post">
    @csrf
    <div class="form-group">
    <label for="deposito">Número depósito</label>
    <input type="text" class="form-control" id="deposito" name="deposito" required>
    {{-- <small id="email" class="form-text text-muted">Você deve inserir o endereço o email utilizado na aposta</small> --}}
    </div>
    
    
    <button type="submit" class="btn btn-primary">Buscar depósito</button>

</form>
</section>
<section class="container">
  <hr class="mt-5 mb-0">
  <div class="row">
    @if(session('warning'))
    <hr>
    <h2 class="col-12 text-center mt-5">{{session('warning')}}</h2>
    @endif

    @if(isset($warning))
    <hr>
    <h2 class="col-12 text-center mt-5">{{$warning}}</h2>
    @endif

    @if(isset($deposito))
    <div class="card card-primary col-sm-10 mx-auto mt-5 w-100">
      {{-- <div class="card-header">
        <h3 class="card-title">Depósito encontrado:</h3>
      </div> --}}
      <h2 class="text-center my-3">Depósito encontrado</h2>
      <hr>
      <div class="card-body table-responsive p-0 mx-auto">
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
                    <a style="max-width: 100px" href="{{route('deposito.reprovar', ['id'=>$deposito->id, 'search'=>true])}}" type="button" class="btn btn-sm  btn-success">Confirmado</a>
                  @else
                    <a style="max-width: 100px" href="{{route('deposito.confirmar', ['id'=>$deposito->id, 'search'=>true])}}" type="button" class="btn btn-sm  btn-primary">Confirmar</a>
                  @endif

                </td>
            </tr>
          
            
          </tbody>
        </table>
      </div>
    </div>
    @endif
  </div>
</section>
    
@endsection