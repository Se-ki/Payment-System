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
        Schema::create('student_payment_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_login_id')->constrained(table: "user_logins");
            $table->integer('receipt_number')->unique();
            $table->bigInteger('reference_number')->unique();
            $table->string('description');
            $table->string('mode');
            $table->date('paid_date');
            $table->float('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_records');
    }
};
