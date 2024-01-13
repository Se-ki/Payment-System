<?php

namespace Database\Seeders;

use App\Models\Description;
use App\Models\LoginUser;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentBalancePayment;
use App\Models\StudentPaymentRecord;
use Database\Factories\DescriptionFactory;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Description::factory(1000)->create();

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
            "school_id" => "20210146",
            "firstname" => "Denzel Ivan Roi",
            "lastname" => "Dupa",
            "year_level" => "3",
            "mobile_number" => "09559216994",
            "address" => "Brgy 9, P-7 Cabadbaran City",
        ]);
        $student5 = Student::factory()->create([
            "school_id" => "20210266",
            "firstname" => "Syn Kyle",
            "middlename" => "Cain",
            "lastname" => "Cael",
            "year_level" => "3",
            "mobile_number" => "09212113681",
            "address" => "Brgy 9, P-7 Cabadbaran City",
        ]);
        $student6 = Student::factory()->create([
            "school_id" => "20210507",
            "firstname" => "Jason Arvin",
            "middlename" => "Aragon",
            "lastname" => "Cardona",
            "year_level" => "3",
            "mobile_number" => "09108452165",
            "address" => "purok 4 brgy 12 CBR city",
        ]);
        $student7 = Student::factory()->create([
            "school_id" => "20210251",
            "firstname" => "Joyce",
            "middlename" => "Macula",
            "lastname" => "Moron",
            "year_level" => "3",
            "mobile_number" => "09153829098",
            "address" => "A. Curato St., Barangay 4, Cabadbaran City, Agusan del Norte",
        ]);
        $student8 = Student::factory()->create([
            "school_id" => "20210022",
            "firstname" => "Kent Melvin",
            "middlename" => "Bayonas",
            "lastname" => "Abenion",
            "year_level" => "3",
            "mobile_number" => "09999245571",
            "address" => "Sto.Niño Magallanes, Agusan del Norte",
        ]);
        $student9 = Student::factory()->create([
            "school_id" => "20210563",
            "firstname" => "Juomell",
            "middlename" => "Vistal",
            "lastname" => "Cenabre",
            "year_level" => "3",
            "mobile_number" => "09121864079",
            "address" => "P-3,Barangay-17 Port Poyohon Poblacion,Butuan City,Agusan Del Norte",
        ]);
        $student10 = Student::factory()->create([
            "school_id" => "20210327",
            "firstname" => "Jio",
            "middlename" => "B",
            "lastname" => "Gulez",
            "year_level" => "3",
            "mobile_number" => "09635501216",
            "address" => "P9 gwapo street, del pilar, cbr, agusan del norte",
        ]);
        $student11 = Student::factory()->create([
            "school_id" => "20210286",
            "firstname" => "Lenard",
            "middlename" => "Abecia",
            "lastname" => "Losdoce",
            "year_level" => "3",
            "mobile_number" => "09922461274",
            "address" => "P-7, Poblacion, Magallanes, Agusan del Norte",
        ]);
        $student12 = Student::factory()->create([
            "school_id" => "20210253",
            "firstname" => "Joie",
            "middlename" => "S",
            "lastname" => "Pasaol",
            "year_level" => "3",
            "mobile_number" => "09472747282",
            "address" => "5, Marcos, Magallanes ",
        ]);
        $student13 = Student::factory()->create([
            "school_id" => "20210247",
            "firstname" => "Marahoney",
            "lastname" => "Alpahando",
            "year_level" => "3",
            "mobile_number" => "09056388893",
            "address" => "Purok 2 Cabiltes Street, Brgy. 1 Cabadbaran City, ADN",
        ]);
        $student14 = Student::factory()->create([
            "school_id" => "20200877",
            "firstname" => "Alvin Rey",
            "middlename" => "Pendica",
            "lastname" => "Andonga",
            "year_level" => "3",
            "mobile_number" => "09092038572",
            "address" => "P-10, CBR,ADN",
        ]);
        $student15 = Student::factory()->create([
            "school_id" => "20215678",
            "firstname" => "Shella",
            "middlename" => "Pendica",
            "lastname" => "Andonga",
            "year_level" => "3",
            "mobile_number" => "09123456789",
            "address" => "P-3 Cabadbaran City",
        ]);

        $admin = Student::factory()->create([
            "firstname" => "Admin",
            "lastname" => "Administrator",
            "year_level" => "4",
            "address" => "Cabadbaran City",
        ]);
        $admin1 = Student::factory()->create([
            "firstname" => "Jee Ann",
            'middlename' => 'Macaputol',
            "lastname" => "Guinsod",
            "year_level" => "3",
            "address" => "Cabadbaran City",
        ]);
        $collector = Student::factory()->create([
            "firstname" => "Collector",
            "middlename" => "Tig",
            "lastname" => "Kolek",
        ]);


        LoginUser::factory()->create([
            "student_id" => $student1->id,
            'username' => 'christiankyle.autor',
            'email' => 'christiankyle.autor@csucc.edu.ph',
            'role_id' => 1,
        ]);

        LoginUser::factory()->create([
            "student_id" => $student2->id,
            'username' => 'jaymar.salas',
            'email' => 'jaymar.salas@csucc.edu.ph',
            'role_id' => 1,
            'email_verified_at' => NOW()
        ]);

        LoginUser::factory()->create([
            "student_id" => $student3->id,
            'username' => 'ahrrol.cervantes',
            'email' => 'ahrrol.cervantes@csucc.edu.ph',
            'role_id' => 1,
            'email_verified_at' => NOW()
        ]);
        LoginUser::factory()->create([
            "student_id" => $student4->id,
            'username' => 'denzelivanroi.dupa',
            'email' => 'denzelivanroi.dupa@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student5->id,
            'username' => 'synkyle.cael',
            'email' => 'synkyle.cael@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student6->id,
            'username' => 'jasonarvin.cardona',
            'email' => 'jasonarvin.cardona@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student7->id,
            'username' => 'joyce.moron',
            'email' => 'joyce.moron@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student8->id,
            'username' => 'kentmelvin.abenion',
            'email' => 'kentmelvin.abenion@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student9->id,
            'username' => 'juomell.cenabre',
            'email' => 'juomell.cenabre@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student10->id,
            'username' => 'jio.gulez',
            'email' => 'jio.gulez@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student11->id,
            'username' => 'lenard.losdoce',
            'email' => 'lenard.losdoce@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student12->id,
            'username' => 'joie.pasaol',
            'email' => 'joie.pasaol@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student13->id,
            'username' => 'marahoney.alpahando',
            'email' => 'marahoney.alpahando@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student14->id,
            'username' => 'alvinrey.andonga',
            'email' => 'alvinrey.andonga@csucc.edu.ph',
            'role_id' => 1,
        ]);
        LoginUser::factory()->create([
            "student_id" => $student15->id,
            'username' => 'shella.andonga',
            'email' => 'shella.andonga@csucc.edu.ph',
            'role_id' => 1,
        ]);


        LoginUser::factory()->create([
            "student_id" => $admin->id,
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role_id' => 3,
            'email_verified_at' => NOW()
        ]);
        LoginUser::factory()->create([
            "student_id" => $admin1->id,
            'username' => 'jeeann.guinsod',
            'email' => 'jeeann.guinsod@csucc.edu.ph',
            'role_id' => 3,
            'email_verified_at' => NOW()
        ]);
        LoginUser::factory()->create([
            "student_id" => $collector->id,
            'username' => 'collector',
            'email' => 'collector@collector.com',
            'role_id' => 2,
            'email_verified_at' => NOW()
        ]);

        Payment::factory(50)->create([
            'student_id' => $student1->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student2->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student3->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student4->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student5->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student6->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student7->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student8->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student9->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student10->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student11->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student12->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student13->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student14->id
        ]);
        Payment::factory(50)->create([
            'student_id' => $student15->id
        ]);
    }
}
