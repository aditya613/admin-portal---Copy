<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
        'name' => 'Amazon',
        'website' => 'https://amazon.jobs',
        'verified' => true
    ]);

    Company::create([
        'name' => 'Google',
        'website' => 'https://careers.google.com',
        'verified' => true
    ]);
    }
}
