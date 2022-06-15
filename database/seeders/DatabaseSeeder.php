<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // было изначально
        // \App\Models\User::factory(10)->create();
        // $this->call(UsersTableSeeder::class);
        //


        // $courses = \App\Models\Course::factory(3)->create(); 
        // $lessons = \App\Models\Lesson::factory(15)->create();
        // $tests = \App\Models\Test::factory(1)->create();
        // $questions = \App\Models\Question::factory(18)->create();
        // $answers = \App\Models\Answer::factory(1)->create();
        $scores = \App\Models\Score::factory(1)->create();

       
        // $lessons_id = $lessons->pluck('id');
        // $courses->each(function ($course) use ($lessons_id) {

        //     \App\Models\Lesson::factory(3)->create([
        //         'course_id' => $course->id
        //     ]);
        // });
    }
}