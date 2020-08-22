<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function () {
    // Controllers Within The "App\Http\Controllers\Api" Namespace
    Route::post('/register'     , 'AuthController@register'         )->name('register');
    Route::post('/login'        , 'AuthController@login'            )->name('login');
});

//Route::middleware('auth:api')->group(function() {

    /* AUTH ROUTES */
    Route::namespace('Api')->group(function () {
        // Controllers Within The "App\Http\Controllers\Api" Namespace
        Route::get('logout'     ,'AuthController@logout'            )->name('logout');
        Route::get('user/me'    ,'AuthController@user'              )->name('user.me');

        Route::namespace('Master')->group(function () {
            // Controllers Within The "App\Http\Controllers\Api\Master" Namespace
            Route::resources([
                'clients' => 'ClientController',
            ]);
        });

        Route::namespace('Client')->group(function () {
            // Controllers Within The "App\Http\Controllers\Api\Master" Namespace
            Route::resources([
                'channels'      => 'ChannelController',
                'departments'   => 'DepartmentController',
                'conversations' => 'ConversationController',
            ]);
        });

    });

//});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
