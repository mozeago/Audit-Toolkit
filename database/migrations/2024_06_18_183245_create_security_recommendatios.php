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
        Schema::create('security_recommendations', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->text('name');
            $table->foreignUuid('security_information_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_recommendations');
        Schema::table('security_recommendations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
