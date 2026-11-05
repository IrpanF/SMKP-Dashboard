<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('findings', function (Blueprint $table) {
            // Kolom lama tetap ada, tetapi tidak wajib diisi.
            $table->string('department_name', 150)->nullable()->change();

            // Klasifikasi temuan
            $table->string('finding_category', 20)->nullable();

            // Rencana Tindak Lanjut (RTL)
            $table->text('rtl_response')->nullable();
            $table->json('rtl_files')->nullable();
            $table->string('auditee', 150)->nullable();
            $table->unsignedInteger('action_days')->default(0);

            // Verifikasi
            $table->text('verified_detail')->nullable();
            $table->date('verified_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('findings', function (Blueprint $table) {
            $table->dropColumn([
                'finding_category',
                'rtl_response',
                'rtl_files',
                'auditee',
                'action_days',
                'verified_detail',
                'verified_date',
            ]);

            // department_name sengaja tidak dikembalikan ke NOT NULL
            // agar rollback tidak gagal jika ada data baru tanpa departemen.
        });
    }
};