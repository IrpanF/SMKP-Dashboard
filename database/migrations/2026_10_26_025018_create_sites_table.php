<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('site_name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(
                ['company_name', 'site_name'],
                'sites_company_site_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
