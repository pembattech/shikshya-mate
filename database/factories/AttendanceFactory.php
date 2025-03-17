<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::inRandomOrder()->first()->student_id, 
            'teacher_id' => Teacher::inRandomOrder()->first()->teacher_id, 
            'date' => $this->faker->date(), 
            'status' => $this->faker->randomElement(['Present', 'Absent']), 
        ];
    }
}
