<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobSource;

class JobSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobSource::create([
        'name' => 'Company Website',
        'verified' => true
    ]);

    JobSource::create([
        'name' => 'Alumni Referral',
        'verified' => true
    ]);
    }
}
