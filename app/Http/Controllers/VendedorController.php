<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;

class VendedorController extends Controller
{
    public function index()
    {
        return view('app.vendedores.index');
    }

    public function listar(Request $request){
        $vendedores = Vendedor::where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('codigo_vendedor', 'like', '%'.$request->input('codigo_vendedor').'%')
        ->paginate(5);

        return view('app.vendedores.listar', ['vendedores' => $vendedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request){

        $msg = '';

        if($request->input('_token') != '' && $request->input('id') == ''){
            $regras = [
                'nome' => 'required|min:3|max:50',
                'codigo_vendedor' => 'required|min:3|max:20'
            ];

            $feedback = [
                'nome.required' => 'O campo Nome deve ser preenchido',
                'nome.min' => 'O campo Nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo Nome deve ter no mínimo 40 caracteres',
                'codigo_vendedor.required' => 'O campo Código vendedor deve ser preenchido',
                'codigo_vendedor.min' => 'O campo Código vendedor deve ter no mínimo 3 caracteres',
                'codigo_vendedor.max' => 'O campo Código vendedor deve ter no máximo 40 caracteres'
            ];

            $request->validate($regras, $feedback);

            $vendedor = new Vendedor();
            $vendedor->create($request->all());
        }

        if($request->input('_token') != '' && $request->input('id') != ''){
            $vendedor = Vendedor::find($request->find('id'));
            $update = $vendedor->update($request->all());

            if($update){
                $msg = 'Update realizado com sucesso';
            }else{
                $msg = 'Update apresentou problema';
            }

            return redirect()->route('app.vendedores.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.vendedores.adicionar');
    }

    public function editar($id, $msg = ''){
        $vendedor = Vendedor::find($id);

        return view('app.vendedores.adicionar', ['vendedor' => $vendedor, 'msg' => $msg]);
    }
}
