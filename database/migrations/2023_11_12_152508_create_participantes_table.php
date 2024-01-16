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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string("documento")->unique();
            $table->string("tipo_documento");
            $table->string("primer_nombre")->nullable();
            $table->string("segundo_nombre")->nullable();
            $table->string("primer_apellido")->nullable();
            $table->string("segundo_apellido")->nullable();
            $table->string("nombre_completo");
            $table->string("telefono",30)->nullable();
            $table->string("direccion")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
