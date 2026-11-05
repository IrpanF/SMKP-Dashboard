<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('findings', 'function_name')) {
            Schema::table('findings', function (Blueprint $table) {
                $table->string('function_name', 150)->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('findings', 'function_name')) {
            Schema::table('findings', function (Blueprint $table) {
                $table->dropColumn('function_name');
            });
        }
    }
};