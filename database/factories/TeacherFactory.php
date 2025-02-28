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
            'user_id' => \App\Models\User::factory()->create(['role' => 'student'])->id,
            'subject' => $this->faker->randomElement(['Math', 'Science', 'English', 'History', 'Geography']),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'hire_date' => $this->faker->date(),
        ];
    }
}
