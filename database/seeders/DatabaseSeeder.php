<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\TeacherSubject;
use App\Models\AcademicRecord;
use App\Models\Guardian;
use App\Models\Exam;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Classroom::factory(10)->create();
        // run section factory internally to create sections for students
        Student::factory(120)->create();
        AcademicRecord::factory(50)->create();
        TeacherSubject::factory(5)->create(); // Create 5 teacher-subject associations to link teachers with subjects
        // Guardian::factory(10)->create();
        Attendance::factory(10)->create();
        
        // Attendance::factory(30)->create();
        Exam::factory(5)->create();
        // TODO: Factory for ExamResult, Notification etc.
    }
}
