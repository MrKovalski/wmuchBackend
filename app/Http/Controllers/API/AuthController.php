<?php

namespace App\Http\Controllers\API;

use App\Organisation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function generateAccessToken($user)
    {
        $token = $user->createToken($user->email.'-'.now());

        return $token->accessToken;
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'working_status' => 'required',
            'hour_rate' => 'required',
            'organisation_name' => 'required|min:2'
        ]);

        $organisation = Organisation::create([
            'name' => $request->organisation_name,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'working_status' => $request->working_status,
            'hour_rate' => $request->hour_rate,
            'role_id' => 1,
            'organisation_id' => $organisation->name,

        ]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if( Auth::attempt($credentials) ) {
            $user = Auth::user();

            $token = $this->generateAccessToken($user);

            return response()->json(['token' => $token]);

        }
    }


    public  function  logout(Request  $request){
        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been successfully logged out!';
        return response($response, 200);
    }




}
