<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;

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
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
    Route::apiResource('articles', ArticleController::class);

    Route::put('article-views-increment', [App\Http\Controllers\Api\ArticleController::class, 'viewsIncrement']);
    Route::put('article-likes-increment', [App\Http\Controllers\Api\ArticleController::class, 'likesIncrement']);

});

// Route::group(['middleware' => ['role:Admin']], function () {
//     Route::apiResource('users', UserController::class);
//     Route::apiResource('roles', RoleController::class);
//     Route::apiResource('permissions', PermissionController::class);
// });