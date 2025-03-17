<?php

namespace Database\Factories;

use App\Models\Guardian;
use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guardian>
 */
class GuardianFactory extends Factory
{
    protected $model = Guardian::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => user::inRandomOrder()->first()->user_id,
            'student_id' => Student::inRandomOrder()->first()->student_id,
            'contact_info' => $this->faker->email(),
            'father_name' => $this->faker->name('male'),
            'mother_name' => $this->faker->name('female'),
            'occupation' => $this->faker->jobTitle(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
