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
  <h1>Edição de Benefícios</h1>
@endsection

@section('content')
  <div class="row">
    @foreach($planos as $plano)
    <div class="card card-primary card-outline mb-4 col-sm-5 mx-3">
      <div class="card-body">
        <h3>Plano {{$plano->nome}}</h3><hr>
        <h5>Lista de Benefícios</h4>
        <ul>
          @foreach ($planosComBeneficios[$plano->id] as $beneficio)
              <li>{{$beneficio->texto}} - <a href="{{route('planos.vantagens.delete', ['id'=>$beneficio->id])}}">[DEL]</a></li>
          @endforeach
        </ul>
        {{-- <form role="form" method="POST" action="{{route('plano.editAction', ['id'=>$plano->id])}}"> 
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="titular">Nome do Plano</label>
              <input type="text" class="form-control" id="titular" name="titular" value="{{$plano->titular}}" required>
            </div>
            
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form> --}}
        <hr>
        <form action="{{route('planos.vantagens.insert', ['id'=>$plano->id])}}" method="POST">
          @csrf
          <label for="">Novo Benefício</label><br>
          <input type="text" name="beneficio" required>
          <input type="submit" value="Adicionar">
        </form>
      </div>
    </div>
    @endforeach
  </div>
  

@endsection