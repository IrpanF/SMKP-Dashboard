
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('findings', function (Blueprint $table) {
            $table->id();

            // Relasi ke audit SMKP
            $table->foreignId('smkp_audit_id')
                ->constrained('smkp_audits')
                ->cascadeOnDelete();

            // Informasi administrasi temuan
            $table->string('finding_criteria', 1);
            $table->string('form_no', 100);
            $table->date('audit_date');
            $table->string('revision', 20)->default('00');
            $table->string('finding_no', 100);
            $table->unsignedInteger('page')->nullable();

            // Informasi unit kerja dan lokasi
            $table->string('department_name', 150);
            $table->string('location_name', 150);
            $table->string('function_name', 150)->nullable();

            // Acuan audit
            $table->string('standard', 150);

            $table->timestamps();

            $table->index(['smkp_audit_id', 'finding_no']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('findings');
    }
};
