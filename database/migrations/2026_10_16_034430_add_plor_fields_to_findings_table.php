<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('findings', function (Blueprint $table) {
            $table->text('problem')->nullable();
            $table->text('area_temuan')->nullable();
            $table->text('objective')->nullable();
            $table->text('matriks')->nullable();
            $table->text('risk')->nullable();
            $table->text('recommendation')->nullable();
            $table->json('evidence_files')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('findings', function (Blueprint $table) {
            $table->dropColumn([
                'problem',
                'area_temuan',
                'objective',
                'matriks',
                'risk',
                'recommendation',
                'evidence_files',
            ]);
        });
    }
};
