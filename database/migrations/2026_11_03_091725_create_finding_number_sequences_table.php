<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finding_number_sequences', function (Blueprint $table) {
            $table->id();
            $table->string('category_code', 20);
            $table->string('site_code', 20);
            $table->unsignedInteger('last_number')->default(0);
            $table->timestamps();

            $table->unique(
                ['category_code', 'site_code'],
                'finding_sequence_category_site_unique'
            );
        });

        $categories = ['MNR', 'MYR', 'CRITICAL', 'OFI'];

        $sites = [
            'SITBN',
            'SIRBG',
            'SBITBN',
            'ST',
            'SP',
            'OMI',
        ];

        foreach ($categories as $category) {
            foreach ($sites as $site) {
                DB::table('finding_number_sequences')->insert([
                    'category_code' => $category,
                    'site_code' => $site,
                    'last_number' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('finding_number_sequences');
    }
};
