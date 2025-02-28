<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    public function definition()
    {
        return [
            'student_id' => \App\Models\Student::factory(),
            'date' => $this->faker->date,
            'status' => $this->faker->randomElement(['present', 'absent', 'late']),
            'remarks' => $this->faker->sentence,
        ];
    }
}

