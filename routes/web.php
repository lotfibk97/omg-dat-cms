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


Route::get('/test-email',function(){
return new UserMessageCreated('lotfi','admin@odc.com');


});
