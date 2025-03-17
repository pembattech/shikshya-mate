<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'section_name' => $this->faker->randomElement([1, 2, 3, 4]),
            'class_id' => $this->faker->numberBetween(1, 10),
            'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()->user_id,
        ];
    }
}
