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
        Schema::create('deduccion_egreso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_egreso");
            $table->unsignedBigInteger("id_deduccion");          
            $table->foreign("id_egreso")->references('id')->on('egresos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign("id_deduccion")->references('id')->on('deduccions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deduccion_egreso');
    }
};
