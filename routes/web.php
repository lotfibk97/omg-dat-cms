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

use Illuminate\Support\Facades\Input;
use App\Mail\UserMessageCreated;




Route::get('/', function () {
    return view('auth/register');
});
Route::post('/', [

'as' => 'register.create',
'uses' => 'RegistrationController@store'

]);


Route::get('/mail-register',function(){

return 'login';


})->name('email');

Route::post('/mail-register',[
  'as' => 'mail.confirm',
  'uses' => 'RegistrationController@confirmation'


]);


Route::get('/aa', function () {
    return view('welcome');
})->name('password.request');


Route::get('/aaa', function () {
    return view('welcome');
})->name('register');



Route::get('/login',function () {
    return view('auth/login');
  })->name('login');
Route::get('/user/confirmation/{token}','RegistrationController@confirmation')->name('confirmation');
