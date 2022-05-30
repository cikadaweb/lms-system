<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Question;
use App\Models\Test;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\TestResource;

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
        //
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
        $question->correct_answer = $request->correct_answer;
        $question->incorrect_answers = $request->incorrect_answers;
        $question->type = "multiple";
        $question->test_id = $test_id[0]->id;;
        
        $question->save();
        
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
        //
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