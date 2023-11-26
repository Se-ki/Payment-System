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
            $table->id();
            $table->foreignId("student_id")->constrained()->onDelete("cascade");
            $table->foreignId('academic_year_id')->constrained();
            $table->string('description');
            $table->float('amount');
            $table->date('date_post');
            $table->date('deadline');
            $table->string('record_by');
            $table->integer('p_semester')->comment("1 - 1st Semester, 2 - 2nd Semester");
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
