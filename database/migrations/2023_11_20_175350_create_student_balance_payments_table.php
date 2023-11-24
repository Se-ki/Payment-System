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
            $table->foreignId('user_login_id')->constrained(table: "user_logins");
            $table->string('description');
            $table->integer('balance_amount');
            $table->date('date_paid');
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
