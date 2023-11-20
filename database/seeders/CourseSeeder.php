<?php

namespace Database\Seeders;

use App\Models\Courses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                "name" => "Bachelor of Science in Information Technology"
            ],
            [
                "name" => "Diploma in Computer Technology"
            ],
            [
                "name" => "Bachelor of Science in Computer Engineering"
            ],
            [
                "name" => "Bachelor of Science in Electrical Engineering"
            ],
            [
                "name" => "Bachelor of Science in Electrical Technology"
            ]
        ];
        DB::table('courses')->insert($courses);
    }
}
