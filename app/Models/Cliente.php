<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'sobrenome', 'cpf', 'vendedor_id', 'nome_vendedor', 'codigo_vendedor'];
}
