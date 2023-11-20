<?php

namespace Database\Seeders;

use App\Models\Courses;
use App\Models\PaymentRecords;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentRecords::factory(20)->create();
    }
}
