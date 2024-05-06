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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('titulo');
            $table->decimal('presupuesto')->nullable();
            $table->string('fecha_publicacion')->nullable();
            $table->string('hora_publicacion')->nullable();
            $table->text('contenido');
            $table->text('descripcion_recurso');
            $table->string('estado')->default('Borrador');

            $table->unsignedBigInteger('campaign_id');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
