<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('user_responses');
        Schema::dropIfExists('risk_analysis_responses');
        Schema::dropIfExists('research_contributors');
        DB::statement("
            DELETE FROM migrations
            WHERE migration IN ('2024_03_27_185338_create_user_responses_table', '2024_04_07_203129_create_risk_analysis_responses_table','2024_05_01_173555_create_research_contributors_models_table');
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
