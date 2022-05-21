<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Article;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function getUserRole() {
        $user = Auth::user();
        $userRole = DB::table("model_has_roles")->select("role_id")->where("model_id", $user->id)->get();
        $userName = DB::table("users")->select("name")->where("id", $user->id)->get();
        if($userRole[0]->role_id === 9) {
            return [
                "userId" => $user->id,
                "userName" => $userName,
                "userRole" => "Admin",
            ];
        } else if ($userRole[0]->role_id === 10) { 
            return [
                "userId" => $user->id,
                "userName" => $userName,
                "userRole" => "Master",
            ];
        } else {
            return [
                "userId" => $user->id,
                "userName" => $userName,
                "userRole" => "User",
            ];
        }
    }
    public function getPanelInfo() {
        $articles_count = Article::all()->count();
        $courses_count = Course::all()->count();
        $users_count = User::all()->count();
        return [
            "articles_count" => $articles_count,
            "courses_count" => $courses_count,
            "users_count" => $users_count
        ];
    }
    
}