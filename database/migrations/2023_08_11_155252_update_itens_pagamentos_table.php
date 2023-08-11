<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('itens_pagamentos', function (Blueprint $table) {
            $table->string('nm_item')->nullable()->change();
            $table->string('ds_item')->nullable()->change();
            $table->decimal('vl_item', 15, 2)->nullable()->change();
            $table->unsignedInteger('qtd_item')->nullable()->change();
            $table->string('cd_item_venda')->nullable();
            $table->string('tp_situacao')->nullable();
            $table->unsignedInteger('id_cliente_vendedor')->nullable();
            $table->unsignedInteger('id_usuario_vendedor')->nullable();
            $table->unsignedInteger('nu_parcela')->nullable();
            $table->string('tp_legado')->nullable();
            $table->string('tp_produto_servico')->nullable();
            $table->unsignedInteger('id_nbs_ncm')->nullable();
            $table->string('categoria')->nullable();
            $table->unsignedInteger('id_cnae')->nullable();
            $table->unsignedInteger('id_cst')->nullable();
            $table->string('tx_iss')->nullable();
            $table->string('tp_principal')->nullable();
            $table->json('pivot')->nullable();  // Campo JSON
        });
    }

    public function down()
    {
        Schema::table('itens_pagamentos', function (Blueprint $table) {
            $table->string('nm_item')->nullable(false)->change();
            $table->string('ds_item')->nullable(false)->change();
            $table->decimal('vl_item', 15, 2)->nullable(false)->change();
            $table->unsignedInteger('qtd_item')->nullable(false)->change();
            $table->dropColumn([
                'cd_item_venda',
                'tp_situacao',
                'id_cliente_vendedor',
                'id_usuario_vendedor',
                'nu_parcela',
                'tp_legado',
                'tp_produto_servico',
                'id_nbs_ncm',
                'categoria',
                'id_cnae',
                'id_cst',
                'tx_iss',
                'tp_principal',
                'pivot',
            ]);
        });
    }
};
