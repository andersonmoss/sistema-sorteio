@extends('layout')
@section('conteudo')
<section class="container mt-5">
<h1 class="h2 text-center mb-5">Realizar aposta {{$planoNome}}</h1>
<form class="mx-auto" style="max-width: 650px;" method="post" action="{{route('registrarApostaAction')}}">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nome">Nome Completo</label>
            <input type="text" class="form-control" id="nome" placeholder="José Luiz Maria" required name="nome">
        </div>
        <div class="form-group col-md-6">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" id="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" placeholder="(21) 99999-9999" required name="telefone">
        </div>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="joseluiz@hotmail.com" required name="email">
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="comprovante">Código do comprovante de depósito</label>
            <input type="number" class="form-control" id="comprovante" placeholder="Apenas numeros. Ex: 12514862" required name="numero_comprovante">
        </div>
        
        <div class="form-group col-md-6">
            <label>Banco</label>
            <select class="form-control" name="banco">
                <option value="1">Banco do Brasil </option>
                <option value="2">Bradesco</option>
                <option value="3">Itaú</option>
                <option value="4">Santander</option>
            </select>
        </div>
    </div>
    <div class="form-row px-1">
    <label class="d-block w-100 text-center text-uppercase">Numero(s) da aposta - Cliente {{$planoNome}} escolhe {{$plano}} número(s)</label>
        @for ($i = 1; $i <= $plano; $i++)
            <label class="d-block w-100">Numero {{$i}}</label>
            <input type="number" class="form-control mb-3" name="numeros_aposta[]" min="0" max="9999" id="numero">
        @endfor
    
    </div>
    
    <button type="submit" class="btn btn-success mt-4 mb-5">Cadastrar aposta</button>
    <a href="{{route('welcome')}}" class="btn btn-primary mt-4 mb-5">Página inicial</a>
</form>
</section>
@endsection
 {{-- @section('inviso')
 INSERIR APOSTA <br>
 ===========<br><br>
 <form method="post" action="{{route('registrarApostaAction')}}">
     @csrf
     <label>Nome:</label>
     <input type="nome" name="nome" required><br><br>
     ------------------ <br> 
 
     <label>Email:</label>
     <input type="email" name="email" required><br><br>
     ------------------<br>  
 
     <label>Telefone:</label>
     <input type="tel" name="telefone" placeholder="21999999999" required><br><br>
     ------------------<br>  
 
     <label>Codigo Comprovante:</label>
     <input type="number" name="numero_comprovante" required><br><br>
     ------------------<br>  
 
     <label>Numeros da aposta:</label><br><br>
     
     <input required style="width: 40px" placeholder="00" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}" type="number" name="numero_aposta[]" max="99">
     <input required style="width: 40px" placeholder="00" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}" type="number" name="numero_aposta[]" >
     <input required style="width: 40px" placeholder="00" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}" type="number" name="numero_aposta[]" >
     <input required style="width: 40px" placeholder="00" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}" type="number" name="numero_aposta[]" >
 
 
     <br><br>
     <input type="submit" value="Entrar">
 
 </form>
 
 <a href="{{route('welcome')}}">[VOLTAR - PRINCIPAL]</a>
 <a href="{{route('verificar')}}">[CONSULTAR APOSTA]</a>
 @endsection --}}


 
 <script type="text/javascript" src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/jquery.mask.min.js')}}"></script>


<script type="text/javascript">
$('document').ready(function($){
    $("[name=telefone]").mask("(00) 0000-00009");
    $("[id=numero]").mask("0000");
    $("[id=comprovante]").mask("00000000000000000000000");
});

</script>
