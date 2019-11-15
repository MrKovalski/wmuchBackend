<?php

namespace App\Http\Controllers\API;
use App\User;
use App\WorkingHour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserWorkedHoursController extends Controller
{
    public function show($id){
        $hours = WorkingHour::with('users')->where('id', $id)->get();
        return $hours;
    }
}
