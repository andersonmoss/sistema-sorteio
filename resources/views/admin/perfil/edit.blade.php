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
  <h1>Edição de Conta</h1>
@endsection

@section('content')
  <div class="row">
    @foreach($contas as $conta)
    <div class="card card-primary card-outline mb-4 col-sm-5 mx-3">
      <div class="card-body">
        <h3>{{$conta->banco}}</h3>
        <form role="form" method="POST" action="{{route('perfil.editAction', ['id'=>$conta->id])}}"> 
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="titular">Nome do Titular</label>
              <input type="text" class="form-control" id="titular" name="titular" value="{{$conta->titular}}" required>
            </div>
            <div class="form-group">
              <label for="agencia">Agência</label>
              <input type="text" class="form-control" id="agencia" name="agencia" value="{{$conta->agencia}}" required>
            </div>
            <div class="form-group">
              <label for="numero">Número</label>
              <input type="text" class="form-control" id="numero" name="numero" value="{{$conta->numero}}" required>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
    @endforeach
  </div>
  

@endsection