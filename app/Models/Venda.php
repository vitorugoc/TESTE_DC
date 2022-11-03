<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $fillable = ['valor', 'metodo_pagamento', 'produtos', 'descricao_venda', 'cpf_cliente', 'vencimento', 'parcelas', 'codigo_vendedor', 'proximo_pagamento', 'cliente_id', 'vendedor_id'];
}
