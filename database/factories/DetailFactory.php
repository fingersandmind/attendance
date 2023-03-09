<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detail>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $speciality = ['English', 'Math', 'Science', 'IT'];
        return [
            'position' => $this->faker->jobTitle,
            'division' => 'Grade - '.rand(1,6),
            'speciality' => $speciality[rand(0,3)],
        ];
    }
}
