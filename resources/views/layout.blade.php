<!DOCTYPE html>
<html>
  <head>
    <title>Brincadeira Sorteios</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    
  </head>
  <body class="py-0">
    <header class="bg p-5">
      <h1 class="text-white text-center ">SORTEIO DO BRINCADEIRA</h1>
      <p class="text-white text-center lead">Concorra e realize a festa do seu sonho</p>
    </header>
    
    @yield('conteudo')
    
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  </body>
</html>