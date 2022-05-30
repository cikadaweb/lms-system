<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $correct_answer = $this->faker->sentence(1, true);
        
        $incorrect_answer1 = $this->faker->sentence(1, true);
        $incorrect_answer2 = $this->faker->sentence(1, true);
        $incorrect_answer3 = $this->faker->sentence(1, true);
        $incorrect_answers = $incorrect_answer1 . "," . $incorrect_answer2 . "," . $incorrect_answer3;
        $question = $this->faker->sentence(5, true);

        return [
            'correct_answer' => $correct_answer,
            'incorrect_answers' => $incorrect_answers,
            'question' => $question,
            'type' => "multiple",
            'test_id' => rand(1, 3),
        ];
    }
}