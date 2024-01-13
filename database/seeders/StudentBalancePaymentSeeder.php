<?php

namespace Database\Seeders;

use App\Models\StudentBalancePayment;
use Illuminate\Database\Seeder;

class StudentBalancePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentBalancePayment::factory(500)->create();
    }
}
