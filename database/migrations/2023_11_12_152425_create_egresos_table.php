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
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->string("consecutivo",4)->unique();
            $table->unsignedBigInteger("participante_id");
            $table->date("fecha");
            $table->unsignedBigInteger('valor');
            $table->string("estado");      
            $table->string("forma_pago",2); 
            $table->string("cheque_numero",30);  
            $table->unsignedBigInteger("banco_id");               
            $table->foreign('participante_id')->references('id')->on('participantes')->onDelete('cascade');
            $table->foreign('banco_id')->references('id')->on('bancos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresos');
    }
};
