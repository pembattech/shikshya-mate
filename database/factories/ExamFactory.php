<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'Exam ' . $this->faker->word,
            'class_id' => \App\Models\Classroom::factory(),
            'subject_id' => \App\Models\Subject::factory(),
            'exam_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'total_marks' => 100,
        ];
    }
}

