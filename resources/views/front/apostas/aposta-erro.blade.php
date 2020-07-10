@extends('layout')

@section('conteudo')
<section class="container mt-5">
<h1 class="h2 text-center mb-5">{{$warning}}</h1>

<div class="text-center">
  <a class="btn btn-success" href="{{route('welcome')}}">Página inicial</a>
</div>

</section>
    
@endsection