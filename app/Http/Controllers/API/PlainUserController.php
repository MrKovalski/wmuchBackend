<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Psy\Util\Json;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\WorkingHour;

use App\Http\Resources\UserResource;
use App\Http\Resources\WorkingHourResource;

class PlainUserController extends Controller
{
    //showUser
    public function showUser(Request $request)
    {
//        $user = User::find($request->user()->id);
        $user = User::find(2);

        return new UserResource($user);
    }

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

//        $user = User::findOrFail($request->user()->id);
        $user = User::findOrFail(2);
        $user->update($request->all());
        return new UserResource($user);

    }

    // show all user hours
    public function userHours(Request $request){
//        $user_id = $request->user()->id;
        $user_id = 2;
        $user = User::find($user_id);

        $hours = $user->working_hours;

        return WorkingHourResource::collection($hours);

    }



}
