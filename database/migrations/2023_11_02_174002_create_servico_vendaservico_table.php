<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('servico_vendaservico')) {
            Schema::create('servico_vendaservico', function (Blueprint $table) {
                $table->unsignedBigInteger('servico_id');
                $table->unsignedBigInteger('vendaservico_id');
                $table->timestamps();

                // Adicionar as chaves estrangeiras
                $table->foreign('servico_id')->references('id')->on('servico')->onDelete('cascade');
                $table->foreign('vendaservico_id')->references('id')->on('vendaservico')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('servico_vendaservico', function (Blueprint $table) {
            $table->dropForeign(['servico_id']);
            $table->dropForeign(['vendaservico_id']);
        });

        Schema::dropIfExists('servico_vendaservico');
    }
};
