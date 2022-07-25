<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mechanic;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all()->load('mechanic');

        return UserResource::collection($user,200);
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
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type_id' =>$request->user_type_id,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'image' => $request->image,
            ]);

        if($request->user_type_id == 2)
        {
            $rules = $request->validate([
                'years_experiance' => 'required|integer',
            ]);

            $mechanic = Mechanic::create([
                'years_experiance' =>$request->years_experiance,
                'user_id' => $user->id,
                'status' => "unactivated",
            ]);

            return new UserResource([
                'user' => $user,
                'mechanic' => $mechanic,
            ], 201);
        }

        if($request->file('image'))
        {
            $request->file('image')->store('profile-image');
        }

        return new UserResource($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type_id = $request->user_type_id;
        $user->phone_number = $request->phone_number;
        $user->image = $request->image;
        $user->save();

        return new UserResource($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return new UserResource("User Was Successfully Deleted !!!", 200);
    }
}
