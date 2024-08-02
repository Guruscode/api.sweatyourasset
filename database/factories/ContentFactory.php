<?php

namespace Database\Factories;

use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'curricula_id' => Curriculum::inRandomOrder()->first()->id,
            'title' => $this->faker->text(30),
            'video_url' => 'https://www.youtube.com/watch?v=wffwhmPphcs',
        ];
    }
}
