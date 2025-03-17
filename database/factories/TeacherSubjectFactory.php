<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\TeacherSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherSubjectFactory extends Factory
{
    protected $model = TeacherSubject::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id' => Teacher::factory(),
            'subject_id' => Subject::factory(),
        ];
    }
}
