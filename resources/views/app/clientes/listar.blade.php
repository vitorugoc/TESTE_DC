@extends('app.layouts.basico')

@section('titulo', 'Cliente')

@section('conteudo')
    @include('app.layouts._partials.topo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Cliente - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('cliente.adicionar') }}">Cadastrar</a></li>
                <li><a href="{{ route('cliente.index') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">

            <div style="width:30%; margin-left:auto; margin-right:auto;">
                <p>Campo de filtros, caso deseje selecionar todos os clientes mantenha em branco!</p>
                <form method="post" action="{{ route('cliente.listar') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{$cliente->id ?? ''}}">
                    <input type="text" name="nome" value="{{$cliente->nome ?? old('nome')}}" placeholder="Nome" class="borda-preta">
                    {{$errors->has('nome') ? $errors->first('nome') : ''}}
                    <input type="text" name="sobrenome" value="{{$cliente->sobrenome ?? old('sobrenome')}}" placeholder="Sobrenome" class="borda-preta">
                    {{$errors->has('sobrenome') ? $errors->first('sobrenome') : ''}}
                    <input type="text" name="cpf" value="{{$cliente->cpf ?? old('cpf')}}" placeholder="CPF" class="borda-preta">
                    {{$errors->has('cpf') ? $errors->first('cpf') : ''}}
                    <input type="text" name="codigo_vendedor" = value="{{old('vendedor_id')}}" placeholder="Código vendedor" class="borda-preta">
                    <button type="submit" class="listar">Pesquisar</button>
                    
                </form>
            </div>

            <div style="width:90%; margin-left:auto; margin-right:auto; margin-top:50px;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sobrenome</th> 
                            <th>CPF</th>
                            <th>Nome Vendedor</th> 
                            <th>Código Vendedor</th>                     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>

                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->sobrenome }}</td>
                            <td>{{ $cliente->cpf }}</td>
                            <td>{{ $cliente->nome_vendedor }}</td>
                            <td>{{ $cliente->codigo_vendedor }}</td>
                            <td> <a href="{{ route('cliente.excluir', $cliente->id) }}">Excluir</a> </td>
                            <td> <a href="{{ route('cliente.editar', $cliente->id) }}">Editar</a> </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$clientes->appends($request)->links()}}
            </div>
        </div>
    </div>
@endsection