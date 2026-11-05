<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        $company = 'PT United Tractors Semen Gresik';

        $sites = [
            'PT Semen Indonesia Tuban',
            'PT Semen Indonesia Rembang',
            'PT Solusi Bangun Indonesia Tuban',
            'PT Semen Tonasa',
            'PT Semen Padang',
            'PT OMI Sale',
        ];

        foreach ($sites as $siteName) {
            Site::firstOrCreate([
                'company_name' => $company,
                'site_name' => $siteName,
            ], [
                'is_active' => true,
            ]);
        }
    }
}
