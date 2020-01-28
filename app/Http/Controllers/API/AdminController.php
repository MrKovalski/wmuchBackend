<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\WorkingHour;

use App\Http\Resources\WorkingHourResource;

class AdminController extends Controller
{
    //updateUser
    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'working_status' => 'required',
            'hour_rate' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();
        $user->update($request->all());
        return new UserResource($user);

    }

    //show user hours
    public function showUserHours(Request $request, $user){
        $searched_user =  User::find($user);
        $hours = $searched_user->working_hour()->where('user_id', $user)->get();

        return WorkingHourResource::collection($hours);

    }
}
