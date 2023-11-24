<?php

namespace Database\Seeders;

use App\Models\RoleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleType::create(["type" => "Student"]);
        RoleType::create(["type" => "Collector"]);
        RoleType::create(["type" => "Admin"]);
    }
}
