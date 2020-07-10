
@extends('layout')

@section('conteudo')
<section class="container mt-5">
<h1 class="h2 text-center mb-5">Insira seu email para conferir o status das suas apostas</h1>
<form class="mx-auto" style="max-width: 400px;" method="post">
    @csrf
    <div class="form-group">
    <label for="email">Endereço de email</label>
    <input type="email" class="form-control" id="email" name="email" required>
    <small id="email" class="form-text text-muted">Você deve inserir o endereço o email utilizado na aposta</small>
    </div>
    
    
    <button type="submit" class="btn btn-primary">Buscar aposta</button>

    <a class="btn btn-success" href="{{route('welcome')}}">Página inicial</a>

</form>
</section>
    
@endsection