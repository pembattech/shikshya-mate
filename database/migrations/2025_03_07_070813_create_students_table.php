<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->foreignId('user_id')->unique()->nullable()->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('date_of_birth');
            $table->foreignId('class_id')->constrained('classrooms', 'class_id')->onDelete('set null');
            $table->foreignId('section_id')->constrained('sections', 'section_id')->onDelete('set null');
            $table->string('roll_number');
            $table->string('address');
            $table->string('phone');
            $table->date('admission_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
