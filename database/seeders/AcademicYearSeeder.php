<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicYear::create(['year' => "2019-2020"]);
        AcademicYear::create(['year' => "2020-2021"]);
        AcademicYear::create(['year' => "2021-2022"]);
        AcademicYear::create(['year' => "2022-2023"]);
        AcademicYear::create(['year' => "2023-2024"]);
    }
}
