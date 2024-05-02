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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('tematica');
            $table->text('descripcion');
            $table->string('fecha_inicio');
            $table->string('fecha_final');
            $table->string('estado')->default('Borrador');
            $table->number('invervalo')->nullable();
            $table->string('audiencia');
            $table->string('presupuesto')->nullable();
            $table->string('objetivo')->nullable();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
