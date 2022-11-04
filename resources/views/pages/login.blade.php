@extends('pages.layouts.basico')

@section('titulo', 'Login')

@section('conteudo')
    @include('pages.layouts._partials.topo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Login</h1>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right:auto;">
                <form action="" method="POST">
                    @csrf
                    <input name="usuario" type="text" value="{{ old('usuario') }}" placeholder="Usuário" class="borda-preta">
                    {{$errors->has('usuario') ? $errors->first('usuario') : ''}}
                    <input name="senha" type="password" value="{{ old('senha')}}" placeholder="Senha" class="borda-preta">
                    {{$errors->has('senha') ? $errors->first('senha') : ''}}
                    <button type="submit" class="borda-preta">Acessar</button>
                </form>
                {{isset($erro) && $erro != '' ? $erro : ''}}
            </div>
        </div>
    </div>