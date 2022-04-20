<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function __invoke() {
        $user = Auth::user();
        $userRole = DB::table("model_has_roles")->select("role_id")->where("model_id", $user->id)->get();
        return $userRole;
    }
}