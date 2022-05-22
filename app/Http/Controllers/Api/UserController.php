<?php

namespace App\Http\Controllers\Api;

use App\Actions\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::allPaginate(10);
        return UserResource::collection($users);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserAction $userAction)
    {
        $user = $userAction->run($request->all());

        if ($request->has('role')) {
            $user->assignRole($request->input('role'));
        }

        if ($request->has('permissions')) {
            $user->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
        }


        return response(['message'=>'User Created', 'user'=>$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findById($id);
        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "User not found"
            ])->setStatusCode(404);
        }

        return new UserResource($user);
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
    public function update(EditRequest $request, User $user)
    {
        $user->update($request->validated());

        if ($request->has('role')) {
            $user->assignRole($request->input('role'));
        }

        if ($request->has('permissions')) {
            $user->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
        }

        return response(['message'=>'User Updated', 'user'=>$user]);

        // refactoring
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         "id" => ["required"],
        //         "name" => ["required"],
        //         "email" => ["required"],
        //         "role" => ["required"],
        //     ]
        //     );
        // if ($validator->fails()) {
        //     return [
        //         "status" => false,
        //         "errors" => $validator->messages()
        //     ];
        // }
        // $model_has_role = DB::table("model_has_roles")->where("model_id", "=", $request->id);
        // return $model_has_role;

        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->save();
    
        // return [
        //     "status" => true,
        //     "user" => $user
        // ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();


    }

    public function getUsersBySearch(Request $request) {
        $search_input =  $request->get('searchInput');
        if (!empty($search_input)) {
            $users = User::findBySearch(5, $search_input);
            return UserResource::collection($users);
        }
    }

    public function getAllUsers()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function exportAllUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    
}