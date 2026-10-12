<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('smkp_criteria', function (Blueprint $table) {
            $table->id();

            $table->foreignId('smkp_element_id')
                ->constrained('smkp_elements')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('parent_id')->nullable();

            $table->string('code', 20);
            $table->string('name');

            $table->text('description')->nullable();

            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique('code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('smkp_criteria');
    }
};