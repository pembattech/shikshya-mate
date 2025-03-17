<?php

namespace Database\Factories;

use App\Models\ParentStudent;
use App\Models\Parent;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParentStudentFactory extends Factory
{
    protected $model = ParentStudent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => Parent::factory(20),
            'student_id' => Student::inRandomOrder()->first()->id, // Select random student
        ];
    }
}
