<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;

use App\Http\Controllers\MainController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    
    Route::get('getRole', [MainController::class, '__invoke']);
    Route::apiResource('users', UserController::class);
    Route::get('users-search', [UserController::class, 'getUsersBySearch']);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
    
    Route::apiResource('articles', ArticleController::class);
    Route::get('articles-all', [ArticleController::class, 'getAllArticles']);
    Route::get('articles-search', [ArticleController::class, 'getArticlesBySearch']);
    Route::put('article-views-increment', [ArticleController::class, 'viewsIncrement']);
    Route::put('article-likes-increment', [ArticleController::class, 'likesIncrement']);
    Route::post('article-add-comment', [CommentController::class, 'store'] );
    
    Route::apiResource('article-tags', TagController::class);

    Route::apiResource('courses', CourseController::class);

    Route::get('course-lessons', [LessonController::class, 'getCourseLessons']);
    Route::get('course-lesson', [LessonController::class, 'getCourseLesson']);

});

// Route::group(['middleware' => ['role:Admin']], function () {
//     Route::apiResource('users', UserController::class);
//     Route::apiResource('roles', RoleController::class);
//     Route::apiResource('permissions', PermissionController::class);
// });