@extends('layout')

@section('conteudo')
<section class="container-fluid mt-5">
  @if($existeSorteioVigente)
    <h1 class="display-3 text-center">Sorteio atual: {{$sorteio->name}}</h1>
  <hr>
  <div class="row">
    <div class="col-lg-5 p-5">
      <img class="d-block w-100" src="img/imagemfesta.jpg" alt="California">

    </div>
    
    <div class="col-lg-7 px-4 align-self-center">
      <h1 class="display-4">Informações do sorteio</h1>
      <p class="lead">Procedimento para participar:</p>
      <ul>
        <li><a href="https://brincadeiraecoisaseria.com/planos">Se associar a um plano (pagamento único): Vip, Silver, Gold e Platinum</a></li>
        <li>Cadastrar um email, nome e escolher seus números da sorte</li>
        <li>Aguardar o dia do sorteio e conferir se ganhou</li>
      </ul>
      
      <p class="lead d-line-block">Prêmio:</p>
      <ul>
        <li>Uma festa completa, inteiramente grátis</li>
        
        
      </ul>
      <h2 class="display-4">Apostar Como:</h2>
      
      <a class="btn btn-outline-success btn-md mb-2" href="{{route('registrar', ['plano'=>1])}}">VIP</a>
      <a class="btn btn-outline-success btn-md mb-2" href="{{route('registrar', ['plano'=>2])}}">Silver</a>
      <a class="btn btn-outline-success btn-md mb-2" href="{{route('registrar', ['plano'=>3])}}">Gold</a>
      <a class="btn btn-outline-success btn-md mb-2" href="{{route('registrar', ['plano'=>4])}}">Platinum</a>

      <h2 class="display-4">Consultar aposta:</h2>
      <a class="btn btn-outline-danger btn-md mb-5" href="{{route('verificar')}}">Buscar</a>

    </div>
    
  </div>
  @else
    <h1 class="display-3 text-center">Não há sorteios em andamento</h1>
  @endif
</section>


@endsection

