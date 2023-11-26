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
        if (!Schema::hasTable('produto_vendaproduto')) {
            Schema::create('produto_vendaproduto', function (Blueprint $table) {
                $table->unsignedBigInteger('produto_id');
                $table->unsignedBigInteger('vendaproduto_id');
                $table->timestamps();

                // Adicionar as chaves estrangeiras
                $table->foreign('produto_id')->references('id')->on('produto');
                $table->foreign('vendaproduto_id')->references('id')->on('vendaproduto');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('produto_vendaproduto', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
            $table->dropForeign(['vendaproduto_id']);
        });

        Schema::dropIfExists('produto_vendaproduto');
    }
};
