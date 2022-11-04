@extends('pages.layouts.basico')

@section('titulo', 'Registro')

@section('conteudo')
    @include('pages.layouts._partials.topo')

    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Registro</h1>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right:auto;">
                <form action="" method="POST">
                    @csrf
                    <input name="email" type="text" value="{{ old('email') }}" placeholder="Usuário" class="borda-preta">
                    {{$errors->has('email') ? $errors->first('email') : ''}}
                    <input name="password" type="password" value="{{ old('password')}}" placeholder="Senha" class="borda-preta">
                    {{$errors->has('password') ? $errors->first('password') : ''}}
                    <input name="name" type="password" value="{{ old('name')}}" placeholder="Código Vendedor" class="borda-preta">
                    {{$errors->has('name') ? $errors->first('name') : ''}}
                    <button type="submit" class="borda-preta">Registrar</button>
                </form>
                {{isset($erro) && $erro != '' ? $erro : ''}}
            </div>
        </div>
    </div>