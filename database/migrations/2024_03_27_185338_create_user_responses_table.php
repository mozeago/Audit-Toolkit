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
        Schema::create('user_responses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('answer', ['true', 'false', 'partial']);
            $table->text('organization');
            $table->text('department');
            $table->text('attempt_number');
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('question_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_responses');
        Schema::table('user_responses', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
