<?php 

namespace Database\Factories;

use App\Models\User;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date(),
            'class_id' => $this->faker->numberBetween(1, 10),
            'section_id' => Section::factory(),
            'roll_number' => $this->faker->numerify('###'),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'admission_date' => $this->faker->date(),
        ];
    }
}
