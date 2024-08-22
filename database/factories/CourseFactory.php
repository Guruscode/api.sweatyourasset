<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'overview' => $this->faker->text(100),
            'language' => $this->faker->languageCode,
            'number_of_lessons' => 6,
            'hours' => 10,
            'what_you_will_learn' => [$this->faker->text(20), $this->faker->text(20),],
            'type' => $this->faker->randomElement(['free', 'paid'])
        ];
    }
}
