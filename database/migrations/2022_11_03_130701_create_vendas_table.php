<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->string('produtos', 2000);
            $table->string('descricao_venda', 2000);
            $table->string('vencimento',200)->nullable();
            $table->integer('parcelas')->nullable();
            $table->string('cpf_cliente',11);
            $table->string('codigo_vendedor',50);
            $table->float('proximo_pagamento')->nullable();
            $table->float('valor', 8, 2);
            $table->string('metodo_pagamento', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
};
