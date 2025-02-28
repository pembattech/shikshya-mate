<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Exam;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Teacher::factory(5)->create();
        Classroom::factory(5)->create();
        Student::factory(20)->create();
        Attendance::factory(30)->create();
        Exam::factory(5)->create();
    }
}
