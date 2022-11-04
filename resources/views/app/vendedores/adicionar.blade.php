@extends('app.layouts.basico')

@section('titulo', 'Vendedor')

@section('conteudo')
    @include('app.layouts._partials.topo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Vendedor</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('vendedor.adicionar') }}">Cadastrar</a></li>
                <li><a href="{{ route('vendedor.index') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            {{$msg ?? ''}}
            <div style="width:30%; margin-left:auto; margin-right:auto;">
                <form method="post" action="{{ route('vendedor.adicionar') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{$vendedor->id ?? ''}}">
                    <input type="text" name="nome" value="{{$vendedor->nome ?? old('nome')}}" placeholder="Nome" class="borda-preta">
                    {{$errors->has('nome') ? $errors->first('nome') : ''}}
                    <input type="text" name="codigo_vendedor" value="{{$vendedor->codigo_vendedor ?? old('codigo_vendedor')}}" placeholder="Código vendedor" class="borda-preta">
                    {{$errors->has('codigo_vendedor') ? $errors->first('codigo_vendedor') : ''}}
                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
                
            </div>

        </div>
    </div>
    </div>
@endsection
