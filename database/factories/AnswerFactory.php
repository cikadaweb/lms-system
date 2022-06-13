<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$is_correct_answer = $this->faker->numberBetween(0, 1);
        $answer = $this->faker->sentence(2, true);

        return [
            'is_correct_answer' => 1,
            'answer' => $answer,
            'question_id' => 18,
        ];
    }
}