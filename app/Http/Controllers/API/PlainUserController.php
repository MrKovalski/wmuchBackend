<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public static function convertIds($user)
    {
        $user->role_id = $user->role->role;
        $user->organisation_id = $user->organisation->name;
        if($user->working_status == 1) {
            $user->working_status = "radi";
        } else {
            $user->working_status = "ne radi";
        }
    }
    //showUser
    public function showUser(Request $request)
    {
        $user = Auth::user();

        $this->convertIds($user);

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

        $user = Auth::user();
        $user->update($request->all());

        $this->convertIds($user);

        return new UserResource($user);

    }

    // show all user hours
    public function userHours(Request $request){
//
        $user = Auth::user();

        $hours = WorkingHour::where('user_id', $user->id)->orderBy('start', 'desc')->get();

        return WorkingHourResource::collection($hours);

    }

    //pocni novi sat odnosno novo radno vreme
    //upisuje samo start i user id
    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $start_time = WorkedHoursController::cor_time();

        $request->merge([
            'start' => $start_time->toDateTimeString(),
            'user_id' => $user_id,
        ]);

        $createHoursById = WorkingHour::create($request->all());
        return new WorkingHourResource($createHoursById);

    }


}
