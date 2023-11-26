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
        Schema::create('vendaservico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('profissional_id');
            $table->string('valor', 10);
            $table->string('metodopagamento', 150);
            $table->date('datavenda');
            $table->timestamps();
        });
        
        $table = 'vendaservico';
        Schema::table($table, function (Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->foreign('profissional_id')->references('id')->on('profissional');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendaservico');
    }
};
