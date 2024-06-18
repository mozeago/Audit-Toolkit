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
        Schema::create('security_questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('text');
            $table->foreignUuid('security_sections_id')->constrained();
            $table->index('security_sections_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_questions');
        Schema::table('security_questions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
