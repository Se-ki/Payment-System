<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('student_balance_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('student_id')->constrained()->onDelete("cascade");
            $table->foreignId('academic_year_id')->constrained();
            $table->string('sbp_description');
            $table->bigInteger('sbp_receipt_number');
            $table->float('sbp_amount');
            $table->float('sbp_paid_amount');
            $table->float('sbp_paid_change');
            $table->float('sbp_balance_amount');
            $table->integer("sbp_semester")->comment("1-1st Semester, 2-2nd Semester");
            $table->date('sbp_date_paid');
            $table->string('status');
            $table->string('encoder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('balances');
    }
};
