<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Question;
use App\Models\Test;
use App\Models\Answer;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\TestResource;
use App\Http\Resources\AnswerResource;

use Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Question::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "question" => ["required"],
                "correct_answer" => ["required"],
                "incorrect_answers" => ["required"],
                "course_id" => ["required"]
            ]
            );
            
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages()
            ], 400);
        }
        
        $course_id = $request->course_id;
        $test_id = DB::table("tests")->where("course_id", "=", $course_id)->get(); 

        $question = new Question();
        $question->question = $request->question;
        $question->type = "multiple";
        $question->test_id = $test_id[0]->id;
        $question->save();
        
        // сохраняем правильный ответ
        $answer = new Answer();
        $answer->is_correct_answer = 1;
        $answer->answer = $request->correct_answer;
        $answer->question_id = $question->id;
        $answer->save();

        // сохраняем неправильные ответы
        $incorrect_answers = explode(",", $request->incorrect_answers);

        foreach ($incorrect_answers as $answer) {
            $answer2 = new Answer();
            $answer2->is_correct_answer = 0;
            $answer2->answer = $answer;
            $answer2->question_id = $question->id;
            $answer2->save();
        }
        
        return response()->json([
            "status" => true,
            "question" => $question
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answers = DB::table("answers")->where("question_id", "=", $id)->get(); 
        
        // $test = Test::findById($test_id[0]->id);
        // if (!$test) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "Test not found"
        //     ])->setStatusCode(404);
        // }

        return $answers;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}