{{-- ADMIN - AREA RESTRITA
<br><br>
<a href="{{route('logout')}}">Sair</a> --}}

@extends('adminlte::page')

@section('title', 'Painel Administrativo')

@section('content_header')
    <h1>Conferir Vencedores</h1>
@endsection

@section('content')
  <div class="card card-primary card-outline">
    {{-- <div class="card-header">
      <h3 class="card-title">Todas os sorteios</h3>
    </div> --}}
    
    <div class="card-body">
      <form role="form" method="POST" > 
        @csrf
        <div class="card-body">
       
          <div class="form-group col-sm-3">
            <label>Escolha o sorteio para conferir:</label>
            <select class="custom-select" name="sorteio">
              @foreach ($sorteios as $sorteio)
                <option value="{{$sorteio->id}}">{{$sorteio->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="input-group col-sm-3">
            <input required type="number" min="0" max="999999" placeholder="INSIRA O NÚMERO GANHADOR" name="number" class="form-control">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-check"></i></span>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Conferir</button>
        </div>
      </form>
    </div>
  </div>

@endsection