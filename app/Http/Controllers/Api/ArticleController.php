<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\State;
use App\Http\Resources\ArticleResource;

use Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::allPaginate(10);
        return ArticleResource::collection($articles);


        // $article = Article::first();
        // return new ArticleResource($article);

        // $article = Article::with("comments", "tags", "state")-first();
        // return new ArticleResource($article);

        //Работают

        // $articles = Article::lastLimit(2);
        // return ArticleResource::collection($articles);
        
        // пагниация
        // $articles = Article::allPaginate(1);
        // return $articles;

        // Osprey
        // return ArticleResource::collection(Article::all());

        // return Article::all();
        
        // $article = Article::find(5);
        // return $article;
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
                "body" => ["required"],
            ]
            );
        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $article = new Article();
        $article->title = $request->title;
        $article->img = "/" . $request->img;
        $article->body = $request->body;
        $article->save();

        // создание статистики по умолчанию
        $state = new State();
        $state->likes = 0;
        $state->views = 0;
        $state->article_id = $article->id;
        $state->save();
        

        return [
            "status" => true,
            "article" => $article
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $article = Article::find($id);
        // if (!$article) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "Article not found"
        //     ])->setStatusCode(404);
        // }

        // return $article;

        $article = Article::findById($id);
        return new ArticleResource($article);
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
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => ["required"],
                "img" => ["required"],
                "body" => ["required"],
            ]
            );
        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $article->title = $request->title;
        $article->img = "/" . $request->img;
        $article->body = $request->body;
        $article->save();
        

        return [
            "status" => true,
            "article" => $article
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
    }
}