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
        Schema::create('risk_recommendations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('text');
            $table->enum('question_response', ['true', 'false']);
            $table->foreignUuid('risk_information_id')->constrained()->references('id')->on('risk_information');
            $table->index('risk_information_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('risk_recommendations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('risk_recommendations');
    }
};
