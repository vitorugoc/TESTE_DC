@extends('app.layouts.basico')

@section('titulo', 'Vendas')

@section('conteudo')
    @include('app.layouts._partials.topo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Vendas</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('venda.adicionar') }}">Cadastrar</a></li>
                <li><a href="{{ route('venda.index') }}">Listar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:30%; margin-left:auto; margin-right:auto;">
                <p>Campo de filtros, caso deseje selecionar todas as vendas mantenha em branco!</p>
                <form method="post" action="{{ route('venda.listar') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $venda->id ?? '' }}">
                    <input type="text" name="produtos" value="{{ $venda->produtos ?? old('produtos') }}"
                    placeholder="Produtos" class="borda-preta">
                {{ $errors->has('produtos') ? $errors->first('produtos') : '' }}
                    <input type="text" name="descricao_venda"
                        value="{{ $venda->descricao_venda ?? old('descricao_venda') }}" placeholder="Descrição Venda"
                        class="borda-preta">
                    {{ $errors->has('descricao_venda') ? $errors->first('descricao_venda') : '' }}
                    <input type="text" name="valor" value="{{ $venda->valor ?? old('valor') }}" placeholder="Valor"
                        class="borda-preta">
                    {{ $errors->has('valor') ? $errors->first('valor') : '' }}
                    <input type="text" name="codigo_vendedor"
                        value="{{ $venda->codigo_vendedor ?? old('codigo_vendedor') }}" placeholder="Código Vendedor"
                        class="borda-preta">
                    {{ $errors->has('codigo_vendedor') ? $errors->first('codigo_vendedor') : '' }}
                    <input type="text" name="cpf_cliente" value="{{ $venda->cpf_cliente ?? old('cpf_cliente') }}"
                        placeholder="Cpf Cliente" class="borda-preta">
                    {{ $errors->has('cpf_cliente') ? $errors->first('cpf_cliente') : '' }}
                    
                    <select name="metodo_pagamento" class="borda-preta">
                        <option value="pix">Pix</option>
                        <option value="debito">Débito</option>
                        <option value="credito">Crédito</option>
                        <option value="boleto">Boleto Bancário</option>
                        <option value="dinheiro">Dinheiro</option>
                    </select>
                    <button type="submit" class="listar">Pesquisar</button>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection
