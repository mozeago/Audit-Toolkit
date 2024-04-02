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
        Schema::create('risk_information', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('text');
            $table->foreignUuid('risk_sub_section_id')->constrained();
            $table->index('risk_sub_section_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('risk_information', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('risk_information');
    }
};
