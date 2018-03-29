<?php

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

Route::get('/', function () {
    return view('register');
});
Route::post('/', function () {
$user = new App\User;
$user->email = Input::get('email');
$user->username = Input::get('username');
$user->password = Hash::make(Input::get('password'));
$user->save();
$yourEmail = Input::get('email');
 return view('thanks')->with('yourEmail',$yourEmail);
 });
