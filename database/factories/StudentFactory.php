<?php 

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory()->create(['role' => 'student'])->id,
            'class_id' => \App\Models\Classroom::factory(),
            'section' => $this->faker->randomElement(['A', 'B', 'C']),
            'roll_number' => $this->faker->unique()->randomNumber(6),
            'date_of_birth' => $this->faker->date,
            'parent_id' => \App\Models\User::factory()->create(['role' => 'parent'])->id,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'admission_date' => $this->faker->date,
        ];
    }
}
