<?php

namespace Database\Seeders;

use App\Models\StudentPaymentRecord;
use Illuminate\Database\Seeder;

class StudentPaymentRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentPaymentRecord::factory(500)->create();
    }
}
