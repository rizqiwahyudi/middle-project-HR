<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'PT. Alton Mitra Sejahtera',
            'email' => 'alton.indonesia@gmail.com',
            'logo' => 'logo.png',
            'website_url' => 'https://site.alt-on.net',
        ]);

        Company::create([
            'name' => 'WIMI SEC',
            'email' => 'cs@wimisec.or.id',
            'logo' => 'logo.png',
            'website_url' => 'https://wimisec.or.id',
        ]);
    }
}
