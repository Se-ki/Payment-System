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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId("student_id")->constrained()->onDelete("cascade");
            $table->foreignId('record_by_id')->constrained(table: 'students', column: 'id');
            $table->foreignId('academic_year_id')->constrained();
            $table->foreignId('description_id')->constrained()->onDelete("cascade");
            $table->float('amount');
            $table->dateTime('date_post');
            $table->date('deadline');
            // $table->string('record_by');
            $table->integer('payment_semester')->comment("1 - 1st Semester, 2 - 2nd Semester");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
