<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('student_payment_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete("cascade");
            $table->foreignId('academic_year_id')->constrained();
            $table->string('spr_description');
            $table->bigInteger('spr_receipt_number')->unique();
            $table->bigInteger('spr_reference_number')->unique();
            $table->date('spr_paid_date');
            $table->float('spr_amount');
            $table->integer('spr_semester')->comment("1-1st Semester, 2-2nd Semester");
            $table->string('spr_mode_of_payment');
            $table->string('spr_proof_of_payment_photo');
            $table->timestamps();
        });
        // DB::statement("ALTER TABLE `student_payment_records` ADD `spr_proof_of_payment_photo` LONGBLOB NULL AFTER `spr_mode_of_payment`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('payment_records');
    }
};
