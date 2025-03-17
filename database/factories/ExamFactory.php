<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'Exam ' . $this->faker->word,
            'class_id' => \App\Models\Classroom::inRandomOrder()->first()->class_id,
            'subject_id' => \App\Models\Subject::inRandomOrder()->first()->subject_id,
            'exam_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'total_marks' => 100,
        ];
    }
}

