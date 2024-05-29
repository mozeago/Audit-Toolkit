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
        Schema::create('risk_analysis_responses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('answer', ['true', 'false']);
            $table->text('organization');
            $table->text('department');
            $table->text('attempt_number');
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('risk_sub_section_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_analysis_responses');
        Schema::table('risk_analysis_responses', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
