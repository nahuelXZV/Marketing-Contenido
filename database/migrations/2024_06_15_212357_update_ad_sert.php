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
        // eliminar publication_configuration_id de ad_sets
        Schema::table('ad_sets', function (Blueprint $table) {
            $table->dropForeign(['publication_configuration_id']);
            $table->dropColumn('publication_configuration_id');
        });
        // agregar publication_id
        Schema::table('ad_sets', function (Blueprint $table) {
            $table->unsignedBigInteger('publication_id')->nullable();
            $table->foreign('publication_id')->references('id')->on('publications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ad_sets', function (Blueprint $table) {
            $table->dropForeign(['publication_id']);
            $table->dropColumn('publication_id');
        });
        Schema::table('ad_sets', function (Blueprint $table) {
            $table->unsignedBigInteger('publication_configuration_id')->nullable();
            $table->foreign('publication_configuration_id')->references('id')->on('publication_configurations');
        });
    }
};
