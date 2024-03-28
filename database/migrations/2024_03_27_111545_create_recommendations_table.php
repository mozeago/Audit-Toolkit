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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('content');
            $table->enum('question_response', ['true', 'false']);
            $table->foreignUuid('question_id')->constrained();
            $table->foreignUuid('information_id')->constrained()->references('id')->on('information');
            $table->index('information_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendations');
        Schema::table('recommendations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
