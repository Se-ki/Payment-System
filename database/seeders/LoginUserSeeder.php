<?php

namespace Database\Seeders;

use App\Models\LoginUser;
use Illuminate\Database\Seeder;

class LoginUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoginUser::factory(1500)->create();
    }
}
