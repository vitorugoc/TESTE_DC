@extends('app.layouts.basico')

@section('titulo', 'Cliente')

@section('conteudo')
    @include('app.layouts._partials.topo')
    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Cliente</p>
        </div>

        <div class="menu">
            <ul>
                <li class="centralizado"><a href="{{ route('cliente.adicionar') }}">Cadastrar</a></li>
                <li class="centralizado"><a href="{{ route('cliente.index') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            {{$msg ?? ''}}
            <div style="width:30%; margin-left:auto; margin-right:auto;">
                <form method="post" action="{{ route('cliente.adicionar') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{$cliente->id ?? ''}}">
                    <input type="text" name="nome" value="{{$cliente->nome ?? old('nome')}}" placeholder="Nome" class="borda-preta">
                    {{$errors->has('nome') ? $errors->first('nome') : ''}}
                    <input type="text" name="sobrenome" value="{{$cliente->sobrenome ?? old('sobrenome')}}" placeholder="Sobrenome" class="borda-preta">
                    {{$errors->has('sobrenome') ? $errors->first('sobrenome') : ''}}
                    <input type="text" name="cpf" value="{{$cliente->cpf ?? old('cpf')}}" placeholder="CPF" class="borda-preta">
                    {{$errors->has('cpf') ? $errors->first('cpf') : ''}}
                    <input type="text" name="codigo_vendedor" = value="{{$cliente->codigo_vendedor ?? old('vendedor_id')}}" placeholder="Código vendedor" class="borda-preta">
                    {{$errors->has('codigo_vendedor') ? $errors->first('codigo_vendedor') : ''}}
                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
                
            </div>

        </div>
    </div>
    </div>
@endsection
