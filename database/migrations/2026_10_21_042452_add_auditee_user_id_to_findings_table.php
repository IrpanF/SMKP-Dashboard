
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('findings', function (Blueprint $table) {
            $table->foreignId('auditee_user_id')
                ->nullable()
                ->constrained('users')
                ->noActionOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('findings', function (Blueprint $table) {
            $table->dropForeign(['auditee_user_id']);
            $table->dropColumn('auditee_user_id');
        });
    }
};
