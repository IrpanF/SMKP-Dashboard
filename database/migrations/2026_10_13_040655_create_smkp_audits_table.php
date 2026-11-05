
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('smkp_audits', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->date('audit_date')->nullable();

            $table->foreignId('auditor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('status')->default('draft');
            // draft atau completed

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('smkp_audits');
    }
};
