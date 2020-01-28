<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Organisation;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function work_status($status)
    {
        if($status == 1){
            return 'Radi';
        } else{
            return 'Na godišnjem';
        }
    }
    public function index()
    {
        $user = User::all();
        return UserResource::collection($user);
    }

    public function store(Request $request)
    {

        $oi = Auth::user()->organisation->id;

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

        $request->merge([
            'organisation_id' => $oi,
            'role_id' => 2,
        ]);

        $user = User::create($request->all());
        $user->save();

        PlainUserController::convertIds($user);
        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, $user)
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

        $thisUser = User::findOrFail($user);
        $thisUser->update($request->all());

        $org = $thisUser->organisation->id;


        $updatedUserTxt = $request->merge([
            'id' => $thisUser->value('id'),
            'organisation_id' => $thisUser->organisation->name,
            'role_id' => $thisUser->role->role,
            'working_status' => $this->work_status($request->get('working_status')),
        ]);

        return new UserResource($updatedUserTxt);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json([], 204);
    }
}


