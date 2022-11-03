<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vendedor;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){
        return view('app.clientes.index');
    }

    public function listar(Request $request){
        $id = '';
        $nome = '';

        $vendedor = Vendedor::where('codigo_vendedor', '=', $request->input('codigo_vendedor'))->get();
        foreach($vendedor as $v){
            $id = $v->id;
            $nome = $v->nome;
        }
        $clientes = Cliente::where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('sobrenome', 'like', '%'.$request->input('sobrenome').'%')
        ->where('cpf', 'like', '%'.$request->input('cpf').'%')
        ->where('vendedor_id', 'like', '%'.$id.'%')
        ->where('nome_vendedor', 'like', '%'.$nome.'%')
        ->where('codigo_vendedor','like', '%'.$request->input('codigo_vendedor').'%')
        ->paginate(5);

        return view('app.clientes.listar', ['clientes' => $clientes, 'request' => $request->all(), 'nome' => $nome]);
    }

    public function adicionar(Request $request){

        $msg = '';
        $id = 0;
        $nome = '';
        
        if($request->input('_token') != '' && $request->input('id') == ''){
            $regras = [
                'nome' => 'required|min:3|max:50',
                'sobrenome' => 'required|min:3|max:50',
                'cpf' => 'required|min:11|max:11',
                'codigo_vendedor' => 'required|min:3|max:40'
            ];

            $feedback = [
                'nome.required' => 'O campo Nome deve ser preenchido',
                'nome.min' => 'O campo Nome deve ter no minimo 3 caracteres',
                'nome.max' => 'O campo Nome deve ter no minimo 50 caracteres',
                'codigo_vendedor.required' => 'O campo Codigo vendedor deve ser preenchido',
                'codigo_vendedor.min' => 'O campo Codigo vendedor deve ter no minimo 3 caracteres',
                'codigo_vendedor.max' => 'O campo Codigo vendedor deve ter no maximo 40 caracteres',
                'codigo_vendedor.unique' => 'O Código vendedor deve ser unico',
                'cpf.required' => 'O campo CPF deve ser preenchido',
                'cpf.min' => 'O campo CPF deve ter exatamente 11 caracteres',
                'cpf.max' => 'O campo CPF deve ter exatamente 11 caracteres',
                'sobrenome.min' => 'O campo Sobrenome deve ter no mínimo 3 caracteres',
                'sobrenome.max' => 'O campo Sobrenome deve ter no maximo 50 caracteres',
                'sobrenome.required' => 'O campo Sobrenome deve ser preenchido',
            ];
            
            
            $request->validate($regras, $feedback);
            $vendedor = Vendedor::where('codigo_vendedor', '=', $request->input('codigo_vendedor'))->get();


            foreach($vendedor as $v){
                $id = $v->id;
                $nome = $v->nome;
            }

    
            $cliente = new Cliente();

            $cliente->fill(['nome' => $request->nome, 'sobrenome' => $request->sobrenome, 'cpf' => $request->cpf, 'vendedor_id' => $id, 'nome_vendedor' => $nome, 'codigo_vendedor' => $request->codigo_vendedor]);
            $cliente->save();
        }

        if($request->input('_token') != '' && $request->input('id') != ''){
            $cliente = Cliente::find($request->input('id'));

            $vendedor = Vendedor::where('codigo_vendedor', '=', $request->input('codigo_vendedor'))->get();

            foreach($vendedor as $v){
                $id = $v->id;
                $nome = $v->nome;
            }
            
            if($id >= 1){
                $update = $cliente->fill(['nome' => $request->nome, 'sobrenome' => $request->sobrenome, 'cpf' => $request->cpf, 'vendedor_id' => $id, 'nome_vendedor' => $nome, 'codigo_vendedor' => $request->codigo_vendedor]);
                $update->save();
            }else{
                $update = false;
            }
            
            if($update){
                $msg = 'Update realizado com sucesso';
            }else{
                $msg = 'Update apresentou problema';
            }

            return redirect()->route('cliente.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }
        return view('app.clientes.adicionar');
    }

    public function editar($id, $msg = ''){
        $cliente = Cliente::find($id);

        return view('app.clientes.adicionar', ['cliente' => $cliente, 'msg' => $msg]);
    }

    public function excluir($id){
        Cliente::find($id)->delete();

        return redirect()->route('cliente.index');
    }
}
