<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(6, true);
        $description = $this->faker->paragraph(700, true);
        $preview = mb_substr($description, 0, 300) . '...';

        return [
            'title' => $title,
            'img' => 'https://via.placeholder.com/500/FFFFFF/17A2B8/?text=КУРС',
            'preview' => $preview,
            'is_active' => 1,
            'description' => $description,
            'created_at' => $this->faker->dateTimeBetween('-1 years'),
        ];
    }
}