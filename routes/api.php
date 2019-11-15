<?php


use Illuminate\Http\Request;
use app\Http\Controllers;

    //public
/**
 *  Auth
 *
 * * post| login/
 * * post| register/
 *
 */
    Route::post('register', 'API\AuthController@register');
    Route::post('login', 'API\AuthController@login');


    //private
/**
 *  Auth
 *
 * * get| logout/
 *
 */
    Route::get('logout', 'API\AuthController@logout')
        ->middleware(['auth:api']);

    //user
/**
 *  User
 *
 ** get  | user/
 ** put  | user/
 ** get  | hours/
 ** get  | hours/{hour}
 ** post | hours/
 ** put  | hours/{hour}
 *
 *
 */
    Route::get('user', 'API\PlainUserController@showUser')
        ->middleware(['auth:api']);
    Route::put('user', 'API\PlainUserController@updateUser')
        ->middleware(['auth:api']);
    Route::get('hours', 'API\PlainUserController@userHours')
        ->middleware(['auth:api']);
    Route::get('hours/{hour}', 'API\PlainUserController@userHour')
        ->middleware(['auth:api']);
    Route::post('hours', 'API\PlainUserController@storeHour')
        ->middleware(['auth:api']);
    Route::put('hours/{hour}', 'API\PlainUserController@updateHour')
        ->middleware(['auth:api']);


    //admin
/**
 *  Users
 *
 ** get| admin/users/
 ** get| admin/users/{id}
 ** post| admin/users/
 ** put| uadmin/sers/{id}
 ** delete| admin/users/{id}
 */
    Route::apiResource('admin/users', 'API\UserController')
    ->middleware(['auth:api']);

/**
 *  Hours
 *
 ** get| admin/hours/
 ** get| admin/hours/{id}
 ** post| admin/hours/
 ** put| admin/hours/{id}
 ** delete| admin/hours/{id}
 ** //dodaj admin/user/{id}/hours/
 **
 */
    Route::apiResource('admin/hours', 'API\WorkedHoursController')
        ->middleware(['auth:api']);
    Route::get('admin/user/{user}/hours', 'API\AdminController@showUserHours')
        ->middleware(['auth:api']);
