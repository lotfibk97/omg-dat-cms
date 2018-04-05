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
use App\Models\Publication;
use App\User;

Route::get('/', function () {
  if(Auth::check())
  {
    return redirect()->route('dashboard');
  }
  return redirect()->route('login_admin');
})->name('password.request');

///////////////////////////////////////////////////////

Route::get('/publications', function () { //dd((array) Publication::where('owner',Auth::id()));
  $data= [
    'title' => 'Publications',
    'publications' => DB::select("
      select * from publications
      where user =".Auth::id()
    ),
  ];
  return view('publications/pubList',$data);
})->name('publication.list');

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

Route::post('/publications/new',[
  'as' => 'publication.create',
  'uses' => 'PublicationController@create'
]);

Route::get('/publications/{pub}', function ($pub) {
  $data= [
    'title' => 'Edit Publication',
    'collaborators' => [],
    'pub' => $pub,
    'create' => false,
  ];
  return view('publications/pubForm',$data);
});

Route::post('/publications/{pub}',[
  'as' => 'publication.update',
  'uses' => 'PublicationController@update'

]);


///////////////////////////////////////////////////////

Route::get('/contents/text', function () {
  $data= [
    'title' => 'Contents',
    'type' => 'Text',
  ];
  return view('contents/cntList',$data);
});

Route::get('/contents/image', function () {
  $data= [
    'title' => 'Contents',
    'type' => 'Text',
  ];
  return view('contents/cntList',$data);
});

Route::get('/contents/audio', function () {
  $data= [
    'title' => 'Contents',
    'type' => 'Text',
  ];
  return view('contents/cntList',$data);
});

Route::get('/contents/video', function () {
  $data= [
    'title' => 'Contents',
    'type' => 'Text',
  ];
  return view('contents/cntList',$data);
});

Route::get('/contents/text/{cnt}', function () {
  $data= [
    'title' => 'Text Contents',
    'type' => 'text',
  ];
  return view('contents/text',$data);
});

Route::get('/contents/image/{cnt}', function () {
  $data= [
    'title' => 'Image Contents',
    'type' => 'image',
  ];
  return view('contents/image',$data);
});

Route::get('/contents/audio/{cnt}', function () {
  $data= [
    'title' => 'Audio Contents',
    'type' => 'audio',
  ];
  return view('contents/audio',$data);
});

Route::get('/contents/video/{cnt}', function () {
  $data= [
    'title' => 'Video Contents',
    'type' => 'video',
  ];
  return view('contents/video',$data);
});

///////////////////////////////////////////////////////

Route::get('/collaborators', function () {
    $data = [
        'title' => 'collaborators',
          ];
  return view('collaborators/clbList',$data);
});

Route::get('/profile', function () {
  $data = [
      'title' => 'profiles',
        ];
  return view('auth/profile',$data);
});

///////////////////////////////////////////////////////

Route::get('/files', function () {
  $data = [
      'title' => 'files',
        ];
  return view('contents/files',$data);
});

///////////////////////////////////////////////////////

Route::get('/login',function () {
    $data=[
      'collab' => false,
    ];
    return view('auth/login',$data);
  })->name('login_admin');

Route::get('/collaborators/login',function () {
    $data=[
      'collab' => true,
    ];
    return view('auth/login',$data);
  })->name('login_collab');

Route::post('/login',[
  'as' =>'login',
  'uses'=>'LoginController@check',
  ]);

Route::post('/collaborators/login',[
  'as' =>'collabLogin',
  'uses'=>'LoginController@check',
]);

///////////////////////////////////////////////////////

Route::get('/collaborators/register', function () {
  $data=[
    'collab' => true,
  ];
  return view('auth/register',$data);
})->name('collab.register.get');

Route::post('/collaborators/register', [
  'as' => 'collab.register.create',
  'uses' => 'RegistrationController@collab_store'
]);

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
    'error_name' => '=\')',
    'error_msg' => 'Thank you for your registration, Manage your content with easiness !!!'
  ];
  return view('alerts/msg',$data);
})->name('email');

Route::post('/mail-register',[
  'as' => 'mail.confirm',
  'uses' => 'RegistrationController@confirmation'
// fix the case of unconfirmed email reregister qui ye9ba7
]);










Route::get('/aaa', function () {
    return view('welcome');
})->name('register');



Route::get('/user/confirmation/{token}','RegistrationController@confirmation')->name('confirmation');

Route::get('/dashboard',function(){
if(Auth::check()){
  return view('home');
}
else{
  return redirect('login');
}

})->name('dashboard');




Route::post('/profile',[
    'as' => 'update_profile',
    'uses' => 'ProfileUpdaterController@update'

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
