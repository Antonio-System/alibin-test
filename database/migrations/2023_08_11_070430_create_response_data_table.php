<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('response_data', function (Blueprint $table) {
            $table->id();
            $table->boolean('success');
            $table->string('error_code')->nullable();
            $table->string('error_message')->nullable();
            $table->unsignedBigInteger('request_data_id');

            $table->foreign('request_data_id')->references('id')->on('request_data');
          

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('response_data');
    }
};
