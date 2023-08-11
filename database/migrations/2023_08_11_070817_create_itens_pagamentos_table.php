<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('itens_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_pagamento_id')->nullable();
            $table->unsignedBigInteger('request_data_id')->nullable();
            $table->string('nm_item');
            $table->string('ds_item');
            $table->decimal('vl_item');
            $table->integer('qtd_item')->nullable();

            $table->foreign('link_pagamento_id')->references('id')->on('links_pagamentos');
            $table->foreign('request_data_id')->references('id')->on('request_data');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('itens_pagamentos');
    }
};
