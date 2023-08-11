<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('response_data', function (Blueprint $table) {
            $table->unsignedBigInteger('link_pagamento_id')->nullable();
            $table->foreign('link_pagamento_id')
                  ->references('id')
                  ->on('links_pagamentos')
                  ->onDelete('cascade'); // Esto asegura que si se elimina un LinkPagamento, también se elimina su referencia en ResponseData
        });
    }

    public function down()
    {
        Schema::table('response_data', function (Blueprint $table) {
            $table->dropForeign(['link_pagamento_id']);
            $table->dropColumn('link_pagamento_id');
        });
    }
};
