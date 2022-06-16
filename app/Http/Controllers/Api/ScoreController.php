<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;
use App\Http\Requests\Score\CreateRequest;
use App\Http\Resources\ScoreResource;

use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
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
    public function store(CreateRequest $request)
    {
        $score = new Score();
        $score->score_percentage = $request->score_percentage;
        $score->score_count = $request->score_count;
        $score->user_id =  $request->user_id;

        $test_id = DB::table("tests")->where("course_id", "=", $request->test_id)->get(); 
        $score->test_id = $test_id[0]->id;;

        $score->save();

        return response()->json([
            "status" => true,
            "score" => $score
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
        $scores = DB::table("scores")->where("user_id", "=", $id)->get(); 

        if (!$scores) {
            return response()->json([
                "status" => false,
                "message" => "Scores not found"
            ])->setStatusCode(404);
        }

        return new ScoreResource($scores);
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

    // public function getScoresUsers(Request $request) {
    //     $search_input =  $request->get('searchInput');
    //     if (!empty($search_input)) {
    //         $articles = Article::findBySearch(5, $search_input);
    //         return ArticleResource::collection($articles);
    //     }
    // }
}