<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamResultFactory extends Factory
{
    public function definition()
    {
        return [
            'student_id' => \App\Models\Student::factory(),
            'exam_id' => \App\Models\Exam::factory(),
            'marks_obtained' => $this->faker->numberBetween(0, 100),
            'grade' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'F']),
            'remarks' => $this->faker->sentence,
        ];
    }
}

