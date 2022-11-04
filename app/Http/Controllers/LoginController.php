<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){
        $erro = '';

        if($request->get('erro') == 1){
            $erro = "Usuário e ou senha não existe";
        }

        if($request->get('erro') == 2){
            $erro = 'Necessário realizar login para ter acesso a página';
        }
    
        return view('pages.login', ['titulo' => 'login', 'erro' => $erro]);
    }

    public function autenticar(Request $request){
        $regras = [
            'usuario' => 'required',
            'senha' => 'required',
        ];

        $feedback = [
            'usuario.required' => 'O campo usuário é obrigatório',
            'senha.required' =>  'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('senha'); 

        $user = new User();

        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($usuario->email)){
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            
           return redirect()->route('vendedor.index');
        }else{
            return redirect()->route('login.index', ['erro' => 1]);
        }
        
    }

    public function registrar(Request $request){
        return view('pages.register', ['titulo' => 'registro']);
    }

    public function adicionar(Request $request){
        $regras = [
            'name' => 'required|unique:vendedores,codigo_vendedor|min:3|max:40',
            'password' => 'required|min:3',
            'email' => 'required'
            
        ];

        $feedback = [
            'name.required' => 'O campo Código Vendedor deve ser preenchido',
            'password.required' => 'O campo Senha deve ser preenchido',
            'email.email' => 'O campo Usuário deve ser preenchido',
            'name.unique' => 'O Código de vendedor deve ser unico',
            'name.min' => 'O campo Código Vendedor deve ter no mínimo 3 caracteres',
            'password.min' => 'O campo Senha deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo Código Vendedor deve ter no máximo 40 caracteres'
        ];

        $request->validate($regras, $feedback);

        $user = new User();
        $user->create($request->all());

        
        return redirect()->route('login.index');
        
    }

    public function sair(){
        session_start();
        session_destroy();
        return redirect()->route('login.index');
    }
}
