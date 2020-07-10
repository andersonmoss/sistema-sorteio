@extends('layout')

@section('conteudo')
<section class="container mt-5">
<h1 class="h2 text-center mb-5">Aposta realizada com sucesso, {{$aposta->nome}}!</h1>

<div class="text-center">
  <a class="btn btn-success" href="{{route('verificar')}}">Verificar aposta</a>
</div>

</section>
    
@endsection