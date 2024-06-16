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
        // update publication_configurations
        Schema::table('publication_configurations', function (Blueprint $table) {
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->foreign('campaign_id')->references('id')->on('campaigns');
        });
        // update ad_sets
        Schema::table('ad_sets', function (Blueprint $table) {
            $table->unsignedBigInteger('publication_configuration_id')->nullable();
            $table->foreign('publication_configuration_id')->references('id')->on('publication_configurations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publication_configurations', function (Blueprint $table) {
            $table->dropForeign(['campaign_id']);
            $table->dropColumn('campaign_id');
        });
        Schema::table('ad_sets', function (Blueprint $table) {
            $table->dropForeign(['publication_configuration_id']);
            $table->dropColumn('publication_configuration_id');
        });
    }
};
