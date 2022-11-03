@extends('app.layouts.basico')

@section('titulo', 'Vendedor')

@section('conteudo')
    @include('app.layouts._partials.topo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Vendedor - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('vendedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('vendedor.index') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">

            <div style="width:30%; margin-left:auto; margin-right:auto;">
                <form method="post" action="{{ route('vendedor.listar') }}">
                    @csrf
                    <input type="text" name="nome" placeholder="Nome" class="borda-preta">
                    <input type="text" name="codigo_vendedor" placeholder="Código vendedor" class="borda-preta">
                    <button type="submit" class="borda-preta">Pesquisar</button>
                </form>
            </div>

            <div style="width:90%; margin-left:auto; margin-right:auto; margin-top:50px;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Código Vendedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendedores as $vendedor)
                        <tr>

                            <td>{{ $vendedor->nome }}</td>
                            <td>{{ $vendedor->codigo_vendedor }}</td>
                            <td> <a href="">Excluir</a> </td>
                            <td> <a href="{{ route('vendedor.editar', $vendedor->id) }}">Editar</a> </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$vendedores->appends($request)->links()}}
            </div>
        </div>
    </div>
@endsection