<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('request_data', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->dateTime('dt_validade')->nullable();
            $table->integer('nu_max_pagamentos')->nullable();
            $table->boolean('tp_quantidade')->nullable();
            $table->string('ds_softdescriptor');
            $table->boolean('tp_boleto');
            $table->string('tp_pagamento_boleto');
            $table->integer('nu_max_parcelas_boleto')->nullable();
            $table->integer('dia_cobranca_boleto')->nullable();
            $table->integer('nu_baixa_automatica_boleto')->nullable();
            $table->integer('nu_boleto_dias_vencimento')->nullable();
            $table->boolean('tp_credito');
            $table->string('tp_pagamento_credito');
            $table->integer('nu_max_parcelas_credito')->nullable();
            $table->integer('dia_cobranca_credito')->nullable();
            $table->decimal('vl_total');
            $table->boolean('tp_mostrar_itens_checkout');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('request_data');
    }
};
