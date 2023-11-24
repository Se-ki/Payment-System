<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentBalancePayment;
use App\Models\StudentPaymentRecord;
use App\Models\UserLogin;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student1 = Student::factory()->create([
            "school_id" => "20211296",
            "firstname" => "Christian Kyle",
            "lastname" => "Autor",
            "year_level" => "3",
            "mobile_number" => "09158585694",
            "address" => "Cabadbaran City",
        ]);
        $student2 = Student::factory()->create([
            "firstname" => "Jaymar",
            "lastname" => "Salas",
            "year_level" => "3",
            "address" => "Cabadbaran City",
        ]);
        $student3 = Student::factory()->create([
            "firstname" => "Ahrrol",
            "middlename" => "Dalo",
            "lastname" => "Cervantes",
            "year_level" => "3",
            "address" => "Cabadbaran City",
        ]);
        $student4 = Student::factory()->create([
            "firstname" => "Justine",
            "middlename" => "Pasaol",
            "lastname" => "Bieber",
            "year_level" => "3",
            "address" => "Cabadbaran City",
        ]);

        $user1 = UserLogin::factory()->create([
            "student_id" => $student1->id,
            'username' => 'christiankyle.autor',
            'email' => 'christiankyle.autor@csucc.edu.ph',
            'role' => "student",
            // 'email_verified_at' => NOW()
        ]);

        $user2 = UserLogin::factory()->create([
            "student_id" => $student2->id,
            'username' => 'jaymar.salas',
            'email' => 'jaymar.salas@csucc.edu.ph',
            'role' => 'student',
            'email_verified_at' => NOW()
        ]);

        $user3 = UserLogin::factory()->create([
            "student_id" => $student3->id,
            'username' => 'ahrrol.cervantes',
            'email' => 'ahrrol.cervantes@csucc.edu.ph',
            'role' => 'student',
            'email_verified_at' => NOW()
        ]);

        UserLogin::factory()->create([
            "student_id" => $student4->id,
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'email_verified_at' => NOW()
        ]);

        Payment::factory(30)->create([
            'user_login_id' => $user1->id
        ]);
        Payment::factory(5)->create([
            'user_login_id' => $user2->id
        ]);
        Payment::factory(20)->create([
            'user_login_id' => $user3->id
        ]);

        StudentPaymentRecord::factory(35)->create();

        StudentBalancePayment::factory(500)->create();
    }
}
