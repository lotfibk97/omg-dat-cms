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
use App\Models\Content;


////////////////////////////////////////////////////////////////////////////////
////////////////////////// Dashboard Page /////////////////////////////

Route::get('/', function () {
  if(Auth::check())
  {
    return redirect()->route('dashboard');
  }
  return redirect()->route('welcome');
})->name('password.request');

Route::get('/dashboard',function(){
  if(Auth::check()) return view('layouts/dashboard',["title"=>"dashboard"]);
  return redirect('login');
})->name('dashboard');

Route::get('/welcome',function() {
  return view('layouts/welcome');
})->name('welcome');


////////////////////////////////////////////////////////////////////////////////
////////////////////////// Publications Pages /////////////////////////////

////////////////////////// Publications list
Route::get('/publications', function () {

  $user=User::where('id',Auth::id())->first();

  if ($user->type =="admin")
  $query=DB::select("
      select * from publications
      where user =".Auth::id()."
  ");

  else $query=DB::select("
      select * from publications p
      where exists (
        select * from collaborations c,collaborators cl
        where c.collaborator=cl.id
        and cl.profile=\"".Auth::id()."\"
        and c.publication=p.id
      )
    ");

  $data= [
    'title' => 'Publications',
    'publications' => $query,
  ];
  return view('publications/pubList',$data);
})->name('publication.list');

////////////////////////// GOTO Create Publication Page
Route::get('publications/new', function () {

  $user = User::where('id',Auth::id())->first();

  if($user->type != 'admin'){
    dd('you can\'t');
  }

  $query = DB::select("
    select * from users u
    where u.type=\"profile\"
    and exists (
        select * from collaborators c
        where c.profile=u.id
        and c.user=\"".Auth::id()."\"
      )
  ");

  $data= [
    'title' => 'Edit Publication',
    'collaborators' => $query,
    'create' => true,
  ];
  return view('publications/pubForm',$data);
});

////////////////////////// GETFROM Create Publication Page
Route::post('/publications/new',[
  'as' => 'publication.create',
  'uses' => 'PublicationController@create'
]);

////////////////////////// GOTO Update Publication Page
Route::get('/publications/{pub}', function ($pub) {

  $user = User::where('id',Auth::id())->first();
  $publication = Publication::where('id',$pub)->first();
  if(is_null($publication)) dd('what is dat');
  if ($publication->user != $user->id) dd('not yours');

  $query = DB::select(DB::raw("
    select * from users u
    where u.type=\"profile\"
    and exists (
        select * from collaborations c,collaborators cl
        where c.collaborator=cl.id
        and cl.profile=u.id
        and c.publication=\"".$pub."\"
      )
  "));

  foreach ($query as $collab) {
    $collab->role=(DB::select("
      select role from collaborations c, collaborators cl, users p
      where c.collaborator=cl.id
      and cl.profile=p.id
      and p.id=\"".$collab->id."\"
      and publication=\"".$pub."\"
    "))['0']->role;
  }

  $data= [
    'title' => 'Edit Publication',
    'collaborators' => $query,
    'publication' => Publication::where('id',$pub)->first(),
    'create' => false,
  ];
  return view('publications/pubForm',$data);
});

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
Route::get('/publications/manage/{pub}', function ($pub) {

  $publication=Publication::where('id',$pub)->first();

  $contents=DB::select("
      select * from contents
      where publication=".$pub."
  ");

  foreach($contents as $content) {
      $content->publication=$publication->title;
      $content->owner=User::where('id',$publication->user)->first()->name;
      $content->creator=DB::select("
          select u.name from collaborators cl, users u
          where cl.profile=u.id
          and cl.id=".$content->creator."
      ")[0]->name;
  }

  $data = [
    'publication'=>$pub,
    'contents'=>$contents,
    'selected'=>$publication->selected,
    'rows'=>$publication->rows,
    'scroll'=>$publication->scroll,
  ];

  return view('publications/partition',$data);
})->name('publication.manage');

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
Route::get('/contents/text', function () {

  $user = User::where('id',Auth::id())->first();
  if($user->type == 'admin')
  $contents=DB::select("
      select c.* from contents c , publications p
      where c.publication=p.id
      and p.user=".Auth::id()."
      and c.type=\"text\"
  ");
  else {
  $contents=DB::select("
      select c.* from contents c
      where c.type=\"text\"
      and exists (
          select * from collaborations cb, collaborators cl
          where cb.publication=c.publication
          and cb.collaborator=cl.id
          and cl.profile=".$user->id."
          and ( cb.role=\"editor\" or cb.role=\"publicator\" )
      )
  ");
  }

  // adding publication title
  foreach($contents as $content) {
    $content->publication=DB::select("
        select title from publications
        where id=".$content->publication."
    ")[0]->title;
  }
  // adding creator name
  foreach($contents as $content) {
    $content->creator=User::where('id',$content->creator)->first()->name;
  }

  $data= [
    'title' => 'Text Contents',
    'contents' => $contents,
    'type' =>"text",
  ];
  return view('contents/cntList',$data);
})->name('content.text');

////////////////////////// Image Content list per user
Route::get('/contents/image', function () {

  $user = User::where('id',Auth::id())->first();
  if($user->type == 'admin')
  $contents=DB::select("
      select c.* from contents c , publications p
      where c.publication=p.id
      and p.user=".Auth::id()."
      and c.type=\"image\"
  ");
  else {
  $contents=DB::select("
      select c.* from contents c,publications p
      where c.publication=p.id
      and c.type=\"image\"
      and exists (
          select * from collaborations cb, collaborators cl
          where cb.publication=p.id
          and cb.collaborator=cl.id
          and cl.profile=".$user->id."
          and ( cb.role=\"editor\" or cb.role=\"publicator\" or cb.role=\"media-manager\" )
      )
  ");
  }

  // adding publication title
  foreach($contents as $content) {
    $content->publication=DB::select("
        select title from publications
        where id=".$content->publication."
    ")[0]->title;
  }
  // adding creator name
  foreach($contents as $content) {
    $content->creator=User::where('id',$content->creator)->first()->name;
  }

  $data= [
    'title' => 'Image Contents',
    'contents' => $contents,
    'type' =>"image",
  ];
  return view('contents/cntList',$data);
})->name('content.image');

////////////////////////// Audio Content list per user
Route::get('/contents/audio', function () {

  $user = User::where('id',Auth::id())->first();
  if($user->type == 'admin')
  $contents=DB::select("
      select c.* from contents c , publications p
      where c.publication=p.id
      and p.user=".Auth::id()."
      and c.type=\"audio\"
  ");
  else {
  $contents=DB::select("
      select c.* from contents c,publications p
      where c.publication=p.id
      and c.type=\"audio\"
      and exists (
          select * from collaborations cb, collaborators cl
          where cb.publication=p.id
          and cb.collaborator=cl.id
          and cl.profile=".$user->id."
          and ( cb.role=\"editor\" or cb.role=\"publicator\" or cb.role=\"media-manager\" )
      )
  ");
  }

  // adding publication title
  foreach($contents as $content) {
    $content->publication=DB::select("
        select title from publications
        where id=".$content->publication."
    ")[0]->title;
  }
  // adding creator name
  foreach($contents as $content) {
    $content->creator=User::where('id',$content->creator)->first()->name;
  }

  $data= [
    'title' => 'Audio Contents',
    'contents' => $contents,
    'type' =>"audio",
  ];
  return view('contents/cntList',$data);
})->name('content.audio');

////////////////////////// Video Content list per user
Route::get('/contents/video', function () {

  $user = User::where('id',Auth::id())->first();
  if($user->type == 'admin')
  $contents=DB::select("
      select c.* from contents c , publications p
      where c.publication=p.id
      and p.user=".Auth::id()."
      and c.type=\"video\"
  ");
  else {
  $contents=DB::select("
      select c.* from contents c,publications p
      where c.publication=p.id
      and c.type=\"video\"
      and exists (
          select * from collaborations cb, collaborators cl
          where cb.publication=p.id
          and cb.collaborator=cl.id
          and cl.profile=".$user->id."
          and ( cb.role=\"editor\" or cb.role=\"publicator\" or cb.role=\"media-manager\" )
      )
  ");
  }

  // adding publication title
  foreach($contents as $content) {
    $content->publication=DB::select("
        select title from publications
        where id=".$content->publication."
    ")[0]->title;
  }
  // adding creator name
  foreach($contents as $content) {
    $content->creator=User::where('id',$content->creator)->first()->name;
  }

  $data= [
    'title' => 'Video Contents',
    'contents' => $contents,
    'type' =>"video",
  ];
  return view('contents/cntList',$data);
})->name('content.video');

////////////////////////// GOTO Content fill page
Route::get('/contents/{cnt}', function ($cnt) {

  $content=Content::where('id',$cnt)->first();
  $data= [
    'title' => $content->title,
    'content' => $content,
  ];

  if($content->type=="text")
  return view('contents/text',$data);

  if($content->type=="image")
  return view('contents/image',$data);

  if($content->type=="audio")
  return view('contents/audio',$data);

  if($content->type=="video")
  return view('contents/video',$data);

})->name('content.fill');

////////////////////////// GETFROM Content fill page
Route::post('/contents/{cnt}',[
    'as' => 'content.fill.post',
    'uses' => 'ProfileUpdaterController@fill'
]);

////////////////////////////////////////////////////////////////////////////////

////////////////////////// GOTO Static files management
Route::get('/files', function () {
  $data = [
      'title' => 'files',
        ];
  return view('contents/files',$data);
})->name('content.manage');

////////////////////////////////////////////////////////////////////////////////
////////////////////////// Users Pages /////////////////////////////

///////////////////////// Collaborators List
Route::get('/collaborators', function () {
    $user = User::where('id',Auth::id())->first();
    if ($user->type =="profile") dd("wech dekhlek fihom");

    $collabs=DB::select("
        select * from users u
        where type='profile'
        and exists (
          select * from collaborators cl
          where cl.profile=u.id
          and cl.user=".$user->id."
          )
    ");

    $data = [
        'title' => 'collaborators',
        'collabs' => $collabs,
    ];
  return view('collaborators/clbList',$data);
})->name('collaborator.list');

////////////////////////// Collaborator Delete Request
Route::post('/collaborators/delete/{collab}',[
  'as' => 'collaborator.delete',
  'uses' => 'CollaboratorController@delete'
]);

///////////////////////// GOTO User Profile
Route::get('/profile', function () {
  $user =User::where('id',Auth::id())->first();
  $data = [
      'user' => $user,
      'title' => 'profiles',
  ];
  return view('auth/profile',$data);
})->name('profile.update');

///////////////////////// GETFROM User Profile
Route::post('/profile',[
    'as' => 'profile.update',
    'uses' => 'ProfileUpdaterController@update'
]);

///////////////////////// GOTO ADMIN LOGIN PAGE
Route::get('/login',function () {
    $data=[
      'collab' => false,
    ];
    return view('auth/login',$data);
  })->name('login_admin');

///////////////////////// LOGOUT
Route::get('/logout',function () {
  Auth::logout();
  return redirect()->route('welcome');
})->name('logout');

///////////////////////// GOTO COLLAB LOGIN PAGE
Route::get('/collaborators/login',function () {
    $data=[
      'collab' => true,
    ];
    return view('auth/login',$data);
  })->name('login_collab');

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

///////////////////////// GOTO COLLAB CREATE PAGE

Route::get('/collaborators/register', function () {
  $data=[
    'collab' => true,
  ];
  return view('auth/register',$data);
})->name('collab.register.get');

///////////////////////// GETFROM COLLAB CREATE PAGE
Route::post('/collaborators/register', [
  'as' => 'collab.register.create',
  'uses' => 'RegistrationController@collab_store'
]);

///////////////////////// ADMIN REGISTER WITH MAIL CONFIRMATION
Route::get('/register', function () {
  $data=[
    'collab' => false,
  ];
  return view('auth/register',$data);
})->name('register.get');

Route::post('/register', [
  'as' => 'register.create',
  'uses' => 'RegistrationController@store'
]);

Route::get('/mail-register',function(){
  $data=[
    'error_name' => '=\'D',
    'error_msg' => 'Thank you for your registration, Manage your content with easiness !!!'
  ];
  return view('alerts/msg',$data);
})->name('email');

Route::post('/mail-register',[
  'as' => 'mail.confirm',
  'uses' => 'RegistrationController@confirmation'
]);

Route::get('/user/confirmation/{token}','RegistrationController@confirmation')->name('confirmation');



////////////////////////////////////////////////////////////////////////////////
////////////////////////// Errors Pages /////////////////////////////


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
