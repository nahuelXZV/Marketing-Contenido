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
        Schema::create('ad_sets', function (Blueprint $table) {
            $table->id();
            $table->string('identificador');
            $table->string('nombre');
            $table->string('objetivo_optimizacion');
            $table->string('evento_facturacion');
            $table->string('monto_oferta');
            $table->string('presupuesto_diario');
            $table->string('audiencia');
            $table->string('fecha_inicio');
            $table->string('fecha_final');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_sets');
    }
};
