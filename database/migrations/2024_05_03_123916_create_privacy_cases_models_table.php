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
        Schema::create('privacy_cases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('casename');
            $table->text('casenumber');
            $table->text('casetitle')->unique();
            $table->text('caselink')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacy_cases');
    }
};
