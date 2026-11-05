<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('smkp_criteria_rubrics', function (Blueprint $table) {
            $table->dropUnique('smkp_criteria_rubric_score_unique');

            $table->string('permit_type', 20)
                ->default('umum');

            $table->unique(
                ['smkp_criteria_id', 'permit_type', 'score_level'],
                'smkp_criteria_rubric_type_score_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('smkp_criteria_rubrics', function (Blueprint $table) {
            $table->dropUnique('smkp_criteria_rubric_type_score_unique');
            $table->dropColumn('permit_type');

            $table->unique(
                ['smkp_criteria_id', 'score_level'],
                'smkp_criteria_rubric_score_unique'
            );
        });
    }
};