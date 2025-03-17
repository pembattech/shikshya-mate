<?php

namespace Database\Factories;

use App\Models\AcademicRecord;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicRecordFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::inRandomOrder()->first()->student_id, // Fetching an existing student
            'grade_level' => $this->faker->randomElement(['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5']),
            'subject' => $this->faker->randomElement([
                'Mathematics',
                'Science',
                'English',
                'History',
                'Geography',
            ]),
            'marks' => $this->faker->numberBetween(0, 100),
            'grade' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E']),
            'academic_year' => $this->faker->year(),
        ];
    }
}
