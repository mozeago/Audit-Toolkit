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
        Schema::create('risk_sections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('risk_sections', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('risk_sections');
    }
};
