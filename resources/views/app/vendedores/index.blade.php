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
            <div style="width:30%; margin-left:auto; margin-right:auto;">
                <p>Campo de filtros, caso deseje selecionar todos os vendedores mantenha em branco!</p>
                <form method="post" action="{{ route('vendedor.listar') }}">
                    @csrf
                    <input type="text" name="nome" placeholder="Nome" class="borda-preta">
                    <input type="text" name="codigo_vendedor" placeholder="Código vendedor" class="borda-preta">
                    <button type="submit" class="listar"">Pesquisar</button>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection
