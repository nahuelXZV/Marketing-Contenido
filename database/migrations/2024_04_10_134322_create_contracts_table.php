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
        Schema::create('contract', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->float('costo');
            $table->string('detalle_pago');
            $table->string('descripcion');
            $table->string('documento');
            $table->string('estado_contrato');
            $table->string('tipo_contrato');
            $table->string('estado_pago');
            $table->string('fecha_inicio');
            $table->string('fecha_final');
            $table->text('condiciones');

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customer');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract');
    }
};