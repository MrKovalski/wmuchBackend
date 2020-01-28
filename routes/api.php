<?php


use Illuminate\Http\Request;
use app\Http\Controllers;

    //auth routes

    Route::post('register', 'API\AuthController@register');
    Route::post('login', 'API\AuthController@login');
    Route::get('logout', 'API\AuthController@logout')
        ->middleware(['auth:api']);

    //user routes
    Route::group(['prefix' => 'user', 'middleware' => ['auth:api', 'can:userAccess'], 'namespace' => 'API'], function ()
    {
        Route::get('', 'PlainUserController@showUser');
        Route::patch('', 'PlainUserController@updateUser');

        Route::get('hours', 'PlainUserController@userHours');
        Route::post('hours', 'PlainUsercontroller@store');
        Route::get('hours/{hour}', 'WorkedHoursController@show');
        Route::patch('hours/{hour}', 'WorkedHoursController@update');
    });


    //admin routes
    Route::group(['prefix' => 'admin', 'middleware' => ['auth:api', 'can:adminAccess'], 'namespace' => 'API'], function ()
    {
        Route::get('', 'AdminController@showUser');
        Route::patch('', 'AdminController@updateUser');
        Route::apiResource('users', 'UserController');
        Route::apiResource('hours', 'WorkedHoursController');
        Route::get('users/{user}/hours', 'AdminController@showUserHours');
    });



