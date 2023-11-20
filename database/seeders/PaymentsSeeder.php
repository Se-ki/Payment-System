<?php

namespace Database\Seeders;

use App\Models\Courses;
use App\Models\PaymentRecords;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::factory()->create([
            'username' => 'christiankyle.autor',
            'email' => 'christiankyle.autor@csucc.edu.ph',
            'school_id' => "2021-1296",
            'role' => 'student',
            'email_verified_at' => NOW()
        ]);

        $user2 = User::factory()->create([
            'username' => 'jaymar.salas',
            'email' => 'jaymar.salas@csucc.edu.ph',
            'role' => 'student',
            'email_verified_at' => NOW()
        ]);

        $user3 = User::factory()->create([
            'username' => 'ahrrol.cervantes',
            'email' => 'ahrrol.cervantes@csucc.edu.ph',
            'role' => 'student',
            'email_verified_at' => NOW()
        ]);

        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'school_id' => "0000-0000",
            'role' => 'admin',
            'email_verified_at' => NOW()
        ]);

        Payments::factory(30)->create([
            'user_id' => $user1->id
        ]);
        Payments::factory(5)->create([
            'user_id' => $user2->id
        ]);
        Payments::factory(20)->create([
            'user_id' => $user3->id
        ]);

        PaymentRecords::factory(35)->create();
    }
}
