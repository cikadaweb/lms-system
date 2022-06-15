<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $question = $this->faker->sentence(5, true);
        return [
            'score_percentage' => 80,
            'score_count' => 4,
            'user_id' => 35,
            'test_id' => 2,
        ];
    }
}