<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('smkp_indicators', function (Blueprint $table) {
            $table->id();

            $table->foreignId('smkp_criteria_id')
                ->constrained('smkp_criteria')
                ->cascadeOnDelete();

            $table->text('indicator');

            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('smkp_indicators');
    }
};