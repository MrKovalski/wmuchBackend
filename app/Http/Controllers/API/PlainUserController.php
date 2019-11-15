<?php

namespace App\Http\Controllers\API;

use Psy\Util\Json;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\WorkingHour;

use App\Http\Resources\UsersResource;
use App\Http\Resources\WorkingHoursResource;

class PlainUserController extends Controller
{
    //showUser
    public function showUser(Request $request)
    {
        $user = User::find($request->user()->id);

        return new UsersResource($user);
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

        $user = User::findOrFail($request->user()->id);
        $user->update($request->all());
        return new UsersResource($user);

    }

    // show all user hours
    public function userHours(Request $request){
        $user_id = $request->user()->id;
        $user = User::find($user_id);

        $hours = $user->hours()->where('user_id', $user_id)->get();


        return WorkingHoursResource::collection($hours);



    }

    // show user single hour
    public function userHour(Request $request, $hour){
        $showHoursById = WorkingHour::findOrFail($hour);
        return new WorkingHoursResource($showHoursById);
    }

    // store user hour

    public function storeHour(Request $request){
        $validator = Validator::make($request->all(), [
            'start' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }



        $createHoursById = WorkingHour::create($request->all());

        return new WorkingHoursResource($createHoursById);
    }

    //update user hour
    public function updateHour(Request $request, $hour){
        $validator = Validator::make($request->all(), [
            'start' => 'required',
            'end' => 'required',
            'hours_worked' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $selectedHour = WorkingHour::findOrFail($hour);
        $selectedHour->update($request->all());

        return new WorkingHoursResource($selectedHour);




    }

}
