<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_balance_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->string('sbp_description');
            $table->bigInteger('sbp_receipt_number');
            $table->string('sbp_paid_amount');
            $table->string('sbp_paid_change');
            $table->string('sbp_balance_amount');
            $table->string("sbp_semester");
            $table->date('sbp_date_paid');
            $table->string('status');
            $table->string('encoder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
