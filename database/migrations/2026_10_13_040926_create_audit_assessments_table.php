
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_assessments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('smkp_audit_id')
                ->constrained('smkp_audits')
                ->cascadeOnDelete();

            $table->foreignId('smkp_criteria_id')
                ->constrained('smkp_criteria')
                ->cascadeOnDelete();

            // Nilai 0-4; null jika belum dinilai atau N/A.
            $table->unsignedTinyInteger('score')->nullable();

            // Penanda jika subelemen dinyatakan tidak berlaku.
            $table->boolean('is_na')->default(false);

            $table->text('notes')->nullable();

            $table->timestamps();

            // Satu subelemen hanya punya satu nilai dalam satu audit.
            $table->unique(
                ['smkp_audit_id', 'smkp_criteria_id'],
                'audit_assessments_audit_criteria_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_assessments');
    }
};
