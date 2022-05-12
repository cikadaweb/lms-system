<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Lesson;
use App\Http\Resources\LessonResource;

use Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Lesson::all();
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
                "title" => ["required"],
                "body" => ["required"],
                "course_id" => ["required"]
            ]
            );
            
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages()
            ], 400);
        }

        $lesson = new Lesson();
        $lesson->title = $request->title;
        $lesson->body = $request->body;
        $lesson->course_id = $request->course_id;

        $lesson->save();
        
        return response()->json([
            "status" => true,
            "lesson" => $lesson
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

        // $lessons = DB::table("lessons")->where("id", "=", $id)->get();
        // if (!$lessons) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "Lessons not found"
        //     ])->setStatusCode(404);
        // }

        // return new LessonResource($lessons);
        
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

    public function getCourseLessons(Request $request) {
        $course_id =  $request->get('courseId');
        $lessons = DB::table("lessons")->where("course_id", "=", $course_id)->get();
        return new LessonResource($lessons);
    }

    public function getCourseLesson(Request $request) {
        $lesson_id =  $request->get('lessonId');
        $lessons = DB::table("lessons")->where("id", "=", $lesson_id)->get();
        return new LessonResource($lessons);
    }

    
}