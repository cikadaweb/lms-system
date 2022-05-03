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
    public function index(Request $request)
    {
        $articles = Article::allPaginate(5);
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
                "preview" => ["required"],
                "body" => ["required"],
            ]
            );
            
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages()
            ], 400);
        }

        $article = new Article();
        $article->title = $request->title;
        $article->img = "/" . $request->img;
        $article->preview = $request->preview;
        $article->body = $request->body;
        $article->save();

        // создание статистики по умолчанию
        $state = new State();
        $state->likes = 0;
        $state->views = 0;
        $state->article_id = $article->id;
        $state->save();
        
        return response()->json([
            "status" => true,
            "article" => $article
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
                "preview" => ["required"],
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
        $article->preview = $request->preview;
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
    
    public function viewsIncrement(Request $request) {
        $article = Article::findById($request->id);
        $article->state->increment('views');
        return new ArticleResource($article);

    }

    public function likesIncrement(Request $request) {
        $article = Article::findById($request->id);

        $inc = $request->get('increment');
        $inc ? $article->state->decrement('likes') : $article->state->increment('likes');
        return new ArticleResource($article);
    }

    public function getAllArticles() {
        return Article::all();
    }

    public function getArticlesBySearch(Request $request) {
        $search_input =  $request->get('searchInput');
        if (!empty($search_input)) {
            $articles = Article::findBySearch(5, $search_input);
            return ArticleResource::collection($articles);
        }
    }

}