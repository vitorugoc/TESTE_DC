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
        Schema::table('vendas', function (Blueprint $table){
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
        
        Schema::table('vendas', function (Blueprint $table){
            $table->unsignedBigInteger('vendedor_id');
            $table->foreign('vendedor_id')->references('id')->on('vendedores');
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendas', function (Blueprint $table){
            $table->dropForeign('clientes_vendedor_id_foreign');
            $table->dropColumn('vendedor_id');
        });

        Schema::table('vendas', function (Blueprint $table){
            $table->dropForeign('produtos_cliente_id_foreign');
            $table->dropColumn('cliente_id');
        });
    }
};
