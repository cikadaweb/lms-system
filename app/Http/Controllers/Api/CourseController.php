<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Test;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Collection;

use Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Course::all();
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
                "img" => ["required"],
                "preview" => ["required"],
                "description" => ["required"],
            ]
            );
            
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages()
            ], 400);
        }

        $course = new Course();
        $course->title = $request->title;
        $course->img = $request->img;
        $course->preview = $request->preview;
        $course->description = $request->description;
        $course->save();

        // создание статистики по умолчанию
        $test = new Test();
        $test->category = $course->title;
        $test->course_id = $course->id;
        $test->save();
        
        return response()->json([
            "status" => true,
            "course" => $course
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
        $course = Course::findById($id);
        if (!$course) {
            return response()->json([
                "status" => false,
                "message" => "Course not found"
            ])->setStatusCode(404);
        }

        return new CourseResource($course);
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
    public function update(Request $request, Course $course)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => ["required"],
                "img" => ["required"],
                "preview" => ["required"],
                "description" => ["required"],
            ]
            );
        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $course->title = $request->title;
        $course->img = $request->img;
        $course->preview = $request->preview;
        $course->description = $request->description;
        $course->save();
        

        return [
            "status" => true,
            "course" => $course
        ];
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

    public function getCoursesBySearch(Request $request) {
        $search_input =  $request->get('searchInput');
        if (!empty($search_input)) {
            $courses = Course::findBySearch($search_input);
            return CourseResource::collection($courses);
        }
    }
    public function getCoursesByUser(Request $request) {
        $user_id =  $request->get('idUserCourses');
        if (!empty($user_id)) {
            $collection = collect([]);
            $courses = DB::table("user_course")->where("user_id", "=", $user_id)->get(); 
            
            foreach ($courses as $course) {
                $item = Course::findById($course->course_id);
                $collection->push($item);
            }
            return $collection;
            // return CourseResource::collection($courses);
        }
    }
    
}