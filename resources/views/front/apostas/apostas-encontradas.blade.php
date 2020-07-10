@extends('layout')

@section('conteudo')
<section class="container mt-5">
    @if(count($apostas) == 0) 
        <h1>Não foram encontradas apostas para o email: {{$email}}</h2>
    @else
        <h1 class="h1 text-center mb-5">Apostas encontradas: </h1>
        
        
        
        <table class="table table-striped">
            <thead>
              <tr>
                
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Numeros</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($apostas as $aposta)
                    <tr>
                        
                        <td>{{$aposta->nome}}</td>
                        <td>{{$aposta->email}}</td>
                        <td>{{$aposta->numeros}}</td>
                        @if($aposta->status == 0)
                            <td><strong class="text-danger">PEDENTE</strong></td>
                        @elseif($aposta->vencedora == 1)
                            
                            <td><strong>Aposta Vencedora!</strong></td>
                        @elseif($aposta->status == 1)
                            
                            <td><strong class="text-success">CONFIRMADA</strong></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="text-center mt-5">
            <a class="btn btn-success" href="{{route('welcome')}}">Página Inicial</a>
            
        </div>
    @endif
</section>
    
@endsection



    

