<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/testes', function () {
    $user = \App\Models\User::where('name', 'Ramonzinho')->first();
    \Bouncer::assign('cliente')->to($user);

    dd($user, $user->roles()->first()->name);

    dd($user);
    dd("a", $user, $user->roles()->first()->name);
    \Illuminate\Support\Facades\Auth::user();
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});
