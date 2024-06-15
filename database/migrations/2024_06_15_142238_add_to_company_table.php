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
        Schema::table('company', function (Blueprint $table) {
            $table->string('meta_access_token')->nullable();
            $table->string('meta_page_id_meta')->nullable();
            $table->string('meta_app_id_meta')->nullable();
            $table->string('meta_app_secret')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropColumn('meta_access_token');
            $table->dropColumn('meta_page_id_meta');
            $table->dropColumn('meta_app_id_meta');
            $table->dropColumn('meta_app_secret');
        });
    }
};
