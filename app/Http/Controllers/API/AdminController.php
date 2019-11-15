<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\WorkingHour;

use App\Http\Resources\WorkingHoursResource;

class AdminController extends Controller
{
    public function showUserHours(Request $request, $user){
        $searched_user =  User::find($user);
        $hours = $searched_user->hours()->where('user_id', $user)->get();

        return WorkingHoursResource::collection($hours);

    }
}
