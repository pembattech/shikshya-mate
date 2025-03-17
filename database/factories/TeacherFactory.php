<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'schedule' => $this->faker->optional()->randomElement([
                null,
                json_encode([
                    'monday' => '9 AM - 5 PM',
                    'tuesday' => '9 AM - 5 PM',
                    'wednesday' => '9 AM - 5 PM',
                ])
            ]),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'position' => 'teacher',
            'hire_date' => $this->faker->date(),
        ];
    }
}
