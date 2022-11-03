<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Vendedor;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VendaController extends Controller
{
    public function index()
    {
        return view('app.vendas.index');
    }

    public function listar(Request $request)
    {
        $vendas = Venda::where('produtos', 'like', '%' . $request->input('produtos') . '%')
            ->where('descricao_venda', 'like', '%' . $request->input('descricao_venda') . '%')
            ->where('valor', 'like', '%' . $request->input('descricao_venda') . '%')
            ->where('cpf_cliente', 'like', '%' . $request->input('cpf_cliente') . '%')
            ->where('codigo_vendedor', 'like', '%' . $request->input('codigo_vendedor') . '%')
            ->paginate(5);

        return view('app.vendas.listar', ['vendas' => $vendas, 'request' => $request->all()]);
    }

    public function adicionar(Request $request)
    {

        $msg = '';
        $idCliente = '';
        $idVendedor = '';

        if ($request->input('_token') != '' && $request->input('id') == '') {
            $regras = [
                'codigo_vendedor' => 'required|unique:vendedores|min:3|max:20',
                'produtos' => 'required|max:2000',
                'descricao_venda' => 'required|max:2000',
                'cpf_cliente' => 'required|min:11|max:11|exists:clientes,cpf',
                'codigo_vendedor' => 'required|min:3|max:40|exists:vendedores,codigo_vendedor',
                'valor' => 'required',
                'metodo_pagamento' => 'required',
                'parcelas' => 'required|min:1|max:10'
            ];

            $feedback = [
                'produtos.required' => 'O campo Produtos deve ser preenchido',
                'produtos.max' => 'O campo Produtos deve ter no maximo 2000 caracteres',
                'codigo_vendedor.required' => 'O campo Codigo Vendedor deve ser preenchido',
                'codigo_vendedor.min' => 'O campo Codigo Vendedor deve ter no minmo 3 caracteres',
                'codigo_vendedor.max' => 'O campo Codigo Vendedor deve ter no maximo 40 caracteres',
                'codigo_vendedor.exists' => 'O codigo do vendedor deve ser cadastrado',
                'descricao_venda.required' => 'O campo Descrição Venda deve ser preenchido',
                'descricao_venda.max' => 'O campo Descrição Venda deve ter no maximo 2000 caracteres',
                'cpf_cliente.min' => 'O campo CPF deve ter exatamente 11 caracteres',
                'cpf_cliente.max' => 'O campo CPF deve ter exatamente 11 caracteres',
                'cpf_cliente.required' => 'O campo CPF deve ser preenchido',
                'cpf_cliente.exists' => 'O CPF do cliente deve ser cadastrado',
                'valor.required' => 'O campo Valor deve ser preenchido',
                'metodo_pagamento.required' => 'O campo Metodo Pagamento deve ser preenchido',
                'parcelas.required' => 'O campo Parcelas deve ser preenchido',
                'parcelas.min' => 'O minimo de parcelas e 1',
                'parcelas.max' => 'O maximo de parcelas e 10'

            ];

            $request->validate($regras, $feedback);

            $vendedor = Vendedor::where('codigo_vendedor', '=', $request->input('codigo_vendedor'))->get();
            $cliente = Cliente::where('cpf', '=', $request->input('cpf_cliente'))->get();

            foreach ($vendedor as $v) {
                $idVendedor = $v->id;
            }

            foreach ($cliente as $c) {
                $idCliente = $c->id;
            }

            $vencimento = Carbon::now()->addMonth(1);

            $venda = new Venda();
            $venda->fill([
                'produtos' => $request->produtos, 'descricao_venda' => $request->descricao_venda, 'vencimento' => $vencimento,
                'cpf_cliente' => $request->cpf_cliente, 'codigo_vendedor' => $request->codigo_vendedor,  'valor' => $request->valor,
                'cliente_id' => $idCliente, 'vendedor_id' => $idVendedor, 'parcelas' => $request->parcelas, 'metodo_pagamento' => $request->metodo_pagamento
            ]);

            $venda->save();
        }

        if ($request->input('_token') != '' && $request->input('id') != '') {
            $venda = Venda::find($request->input('id'));

            $vendedor = Vendedor::where('codigo_vendedor', '=', $request->input('codigo_vendedor'))->get();
            $cliente = Cliente::where('cpf', '=', $request->input('cpf_cliente'))->get();

            foreach ($vendedor as $v) {
                $idVendedor = $v->id;
            }

            foreach ($cliente as $c) {
                $idCliente = $c->id;
            }

            $vencimento = Carbon::now()->addMonth(1);

            if($idCliente >= 1 && $idVendedor >= 1){
                $update = $venda->fill([
                    'produtos' => $request->produtos, 'descricao_venda' => $request->descricao_venda, 'vencimento' => $vencimento,
                    'cpf_cliente' => $request->cpf_cliente, 'codigo_vendedor' => $request->codigo_vendedor,  'valor' => $request->valor,
                    'cliente_id' => $idCliente, 'vendedor_id' => $idVendedor, 'parcelas' => $request->parcelas, 'metodo_pagamento' => $request->metodo_pagamento
                ]);
                $update->save();
            }else{
                $update = false;
            }
            

            if ($update) {
                $msg = 'Update realizado com sucesso';
            } else {
                $msg = 'Update apresentou problema';
            }

            return redirect()->route('venda.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.vendas.adicionar');
    }

    public function editar($id, $msg = ''){
        $venda = Venda::find($id);

        return view('app.vendas.adicionar', ['venda' => $venda, 'msg' => $msg]);
    }

    public function excluir($id){
        Venda::find($id)->delete();

        return redirect()->route('venda.index');
    }
}
