<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('smkp_audits', function (Blueprint $table) {
            $table->date('audit_start_date')->nullable();
            $table->date('audit_end_date')->nullable();
        });

        // Salin tanggal audit lama agar data sebelumnya tetap terjaga.
        DB::table('smkp_audits')
            ->whereNotNull('audit_date')
            ->update([
                'audit_start_date' => DB::raw('audit_date'),
                'audit_end_date' => DB::raw('audit_date'),
            ]);
    }

    public function down(): void
    {
        Schema::table('smkp_audits', function (Blueprint $table) {
            $table->dropColumn([
                'audit_start_date',
                'audit_end_date',
            ]);
        });
    }
};