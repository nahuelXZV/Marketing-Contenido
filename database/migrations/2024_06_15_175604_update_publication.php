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
        // agregar datos a la tabla publications
        Schema::table('publications', function (Blueprint $table) {
            $table->string('identicador_creativo')->nullable();
            $table->string('identificador_anuncio')->nullable();
            $table->text('preview')->nullable();
            $table->string('meta_estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn('identicador_creativo');
            $table->dropColumn('identificador_anuncio');
            $table->dropColumn('preview');
            $table->dropColumn('meta_estado');
        });
    }
};
