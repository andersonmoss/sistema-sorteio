<!DOCTYPE html>
<html>
  <head>
    <title>Caravan</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

  </head>
  <body class="py-0">
    
    
    @yield('conteudo')
    
    <script type="text/javascript" src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  </body>
</html>