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
use Illuminate\Http\Request;
use App\Mail\UserMessageCreated;
use App\Models\Publication;
use App\User;
use App\Models\Collaboration;
use App\Models\Collaborator;
use App\Models\Content;



////////////////////////////////////////////////////////////////////////////////
////////////////////////// Dashboard Page /////////////////////////////

/////////////////////////////// Root page
Route::get('/',[
    'as' => 'root',
    'uses' => 'GlobalController@root'
]);

/////////////////////////////// Welcome page
Route::get('/welcome',[
  'as' => 'welcome',
  'uses' => 'GlobalController@welcome'
]);

/////////////////////////////// Blog page
Route::get('/blog/{user}',[
  'as' =>'blog',
  'uses' =>'GlobalController@blog'
]);


////////////////////////////////////////////////////////////////////////////////
////////////////////////// Publications Pages /////////////////////////////

////////////////////////// Publications list
Route::get('/publications',[
  'as' => 'publication.list',
  'uses' => 'PublicationController@list',
]);

////////////////////////// GOTO Create Publication Page
Route::get('publications/new',[
  'as' => 'publication.creation',
  'uses' => 'PublicationController@creation'
]);

////////////////////////// GETFROM Create Publication Page
Route::post('/publications/new',[
  'as' => 'publication.create',
  'uses' => 'PublicationController@create'
]);

////////////////////////// GOTO Update Publication Page
Route::get('/publications/{pub}',[
  'as' => 'publication.modification',
  'uses' => 'PublicationController@modification'
]);

////////////////////////// GETFROM Update Publication Page
Route::post('/publications/{pub}',[
  'as' => 'publication.update',
  'uses' => 'PublicationController@update'
]);

////////////////////////// Publication Delete Request
Route::post('/publications/delete/{pub}',[
  'as' => 'publication.delete',
  'uses' => 'PublicationController@delete'
]);

////////////////////////// Goto Partitionning Page
Route::get('/publications/manage/{pub}', [
  'as' => 'publication.manage',
  'uses' => 'PublicationController@manage'
]);

////////////////////////// GET Publication view page
Route::get('/publications/view/{pub}',[
  'as' => 'publication.view',
  'uses' => 'PublicationController@view'
]);

////////////////////////// AJAX Content Position
Route::post('/ajax',[
  'as' => 'content.ajax',
  'uses' => 'ContentController@ajax'
]);


////////////////////////////////////////////////////////////////////////////////
////////////////////////// Contents Pages /////////////////////////////

////////////////////////// POST Create Content
Route::post('/contents/create/{pub}',[
  'as' => 'content.create',
  'uses' => 'ContentController@create'
]);

////////////////////////// POST Update Content
Route::post('/contents/update/{cnt}',[
  'as' => 'content.update',
  'uses' => 'ContentController@update'
]);

////////////////////////// POST Delete Content
Route::post('/contents/delete',[
  'as' => 'content.delete',
  'uses' => 'ContentController@delete'
]);

////////////////////////// Text Content list per user
Route::get('/contents/text', [
  'as' => 'content.text',
  'uses' => 'ContentController@textList'
]);

////////////////////////// Image Content list per user
Route::get('/contents/image', [
  'as' => 'content.image',
  'uses' => 'ContentController@imageList'
]);

////////////////////////// Audio Content list per user
Route::get('/contents/audio', [
  'as' => 'content.audio',
  'uses' => 'ContentController@audioList'
]);

////////////////////////// Video Content list per user
Route::get('/contents/video', [
  'as' => 'content.video',
  'uses' => 'ContentController@videoList'
]);

////////////////////////// GOTO Content fill page
Route::get('/contents/{cnt}', [
  'as' => 'content.fill',
  'uses' => 'ContentController@filling'
]);

////////////////////////// GETFROM Content fill page
Route::post('/contents/{cnt}',[
    'as' => 'content.fill.post',
    'uses' => 'ContentController@fill'
]);


////////////////////////// GOTO Static files management
Route::get('/files', [
  'as' => 'content.manage',
  'uses' => 'ContentController@static'
]);

////////////////////////////////////////////////////////////////////////////////
////////////////////////// Users Pages /////////////////////////////

///////////////////////// Collaborators List
Route::get('/collaborators', [
  'as' => 'collaborator.list',
  'uses' => 'CollaboratorController@list'
]);

////////////////////////// Collaborator Delete Request
Route::post('/collaborators/delete/{collab}',[
  'as' => 'collaborator.delete',
  'uses' => 'CollaboratorController@delete'
]);

///////////////////////// GOTO User Profile
Route::get('/profile', [
  'as' => 'profile.update',
  'uses' => 'ProfileUpdaterController@modification'
]);

///////////////////////// GETFROM User Profile
Route::post('/profile',[
  'as' => 'profile.update',
  'uses' => 'ProfileUpdaterController@update'
]);

///////////////////////// GOTO ADMIN LOGIN PAGE
Route::get('/login',[
  'as' => 'login_admin',
  'uses' => 'LoginController@adminLog'
]);

///////////////////////// LOGOUT
Route::get('/logout', [
  'as' => 'logout',
  'uses' =>'LoginController@logout'
]);

///////////////////////// GOTO COLLAB LOGIN PAGE
Route::get('/collaborators/login', [
  'as' => 'login_collab',
  'uses' => 'LoginController@collabLog'
]);

///////////////////////// GETFROM ADMIN LOGIN PAGE
Route::post('/login',[
  'as' =>'login',
  'uses'=>'LoginController@check',
  ]);

///////////////////////// GETFROM COLLAB LOGIN PAGE
Route::post('/collaborators/login',[
  'as' =>'collabLogin',
  'uses'=>'LoginController@check',
]);

///////////////////////// GETFROM COLLAB CREATE PAGE
Route::post('/collaborators/register', [
  'as' => 'collab.register.create',
  'uses' => 'RegistrationController@collab_store'
]);

///////////////////////// ADMIN REGISTER WITH MAIL CONFIRMATION
Route::get('/register', [
  'as' =>'register.get',
  'uses' =>'RegistrationController@adminReg'
]);

Route::post('/register', [
  'as' => 'register.create',
  'uses' => 'RegistrationController@store'
]);

Route::post('/mail-register',[
  'as' => 'mail.confirm',
  'uses' => 'RegistrationController@confirmation'
]);

Route::get('/user/confirmation/{token}', [
  'as' =>'confirmation',
  'uses' => 'RegistrationController@confirmation'
]);



////////////////////////////////////////////////////////////////////////////////
////////////////////////// Message Pages /////////////////////////////

Route::get('/mail-register',function(){
  /*$data=[
    'error_name' => '=\'D',
    'error_msg' => 'Thank you for your registration, Manage your content with easiness !!!'
  ];
  return view('alerts/msg',$data);*/
  return redirect()->route('message',"=D","Thank+you+for+your+registration,+Manage+your+content+with+ease!!!");
})->name('email');

Route::get('/message/{title}/{description}',[
  'as' => 'message',
  'uses' => 'GlobalController@message',
]);

Route::get('/error1',function(){
  $data=[
    'error_name' => 'Login error',
    'error_msg' => 'Your account is not validated, please check your email for confirmation'
  ];

  return view('alerts/msg',$data);
})->name('not_validated_error');

Route::get('/error2',function(){
  $data=[
    'error_name' => 'Login error',
    'error_msg' => 'You entered a wrong password'
  ];
  return view('alerts/msg',$data);
})->name('credentials_error');

Route::get('/error3',function(){
  $data=[
    'error_name' => 'Login error',
    'error_msg' => 'This account doesn\'t exist'
  ];
  return view('alerts/msg',$data);
})->name('not_exists_error');
