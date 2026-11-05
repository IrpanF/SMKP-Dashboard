
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('smkp_indicator_rubrics', function (Blueprint $table) {
            $table->id();

            // Relasi ke indikator yang sudah ada
            $table->foreignId('smkp_indicator_id')
                ->constrained('smkp_indicators')
                ->cascadeOnDelete();

            // Tingkat penilaian: 0, 1, 2, 3, 4, atau N/A
            $table->string('score_level', 5);

            // Penjabaran lengkap sesuai dokumen kriteria audit
            $table->longText('description');

            // Urutan penampilan di halaman checklist
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            // Satu indikator tidak boleh memiliki rubrik ganda untuk nilai sama
            $table->unique(
                ['smkp_indicator_id', 'score_level'],
                'smkp_rubric_indicator_score_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('smkp_indicator_rubrics');
    }
};
