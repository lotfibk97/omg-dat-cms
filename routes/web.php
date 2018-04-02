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

return view('auth/waitingValidation');


})->name('email');

Route::post('/mail-register',[
  'as' => 'mail.confirm',
  'uses' => 'RegistrationController@confirmation'
// fix the case of unconfirmed email reregister qui ye9ba7

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

Route::post('/login',[
  'as' =>'login',
  'uses'=>'LoginController@check'

  ]);

Route::get('/user/confirmation/{token}','RegistrationController@confirmation')->name('confirmation');

Route::get('/dashboard',function(){
if(Auth::check()){
  return view('auth/base');
}
else{
  return redirect('login');
}

})->name('dashboard');


Route::get('/error',function(){
  $data=[
    'error_name' => 'Login error',
    'error_msg' => 'Your account is not validaed please check your email'
  ];

  return view('alerts/msg',$data);
})->name('error1');
