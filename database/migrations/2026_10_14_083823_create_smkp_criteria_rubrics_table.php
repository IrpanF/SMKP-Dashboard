
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('smkp_criteria_rubrics', function (Blueprint $table) {
            $table->id();

            $table->foreignId('smkp_criteria_id')
                ->constrained('smkp_criteria')
                ->cascadeOnDelete();

            $table->string('score_level', 5);
            $table->longText('description');
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->unique(
                ['smkp_criteria_id', 'score_level'],
                'smkp_criteria_rubric_score_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('smkp_criteria_rubrics');
    }
};
