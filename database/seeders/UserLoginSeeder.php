<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserLogin::factory()->create();
    }
}
