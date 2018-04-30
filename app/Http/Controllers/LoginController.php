<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Collaborator;
use Hash;
use DB;

class LoginController extends Controller
{
  /////////////////////////////////////////////////////////////////////////
  // Goto admin login
  public function adminLog(Request $request) {
    $data=[
      'collab' => false,
    ];
    return view('auth/login',$data);
  }

  /////////////////////////////////////////////////////////////////////////
  // Goto collab login
  public function collabLog(Request $request) {
    $data=[
      'collab' => true,
    ];
    return view('auth/login',$data);
  }


  /////////////////////////////////////////////////////////////////////////
  // Login POST check
  public function check(Request $request){

    // admin login
    if(is_null($request->admin)){

      $user = User::where('email',$request->email)->where('type','admin')->first();
      // admin user doesnt exist
      if(is_null($user)) {
        return redirect()->route('not_exists_error');
      }
      // admin password false
      if (! Hash::check($request->password,$user->password)) {
        return redirect()->route('credentials_error');
      }
      // account not validated
      if(! $user->is_validated()){
        return redirect()->route('not_validated_error');
      }

      Auth::login($user);
      return redirect()->route('publication.list');

    }

    // collaborator login
    $query = DB::select("
      select * from users profile
      where profile.type=\"profile\"
      and profile.email=\"".$request->email."\"
      and exists (
          select * from users u
          where u.email=\"".$request->admin."\"
          and exists (
              select * from collaborators c
              where c.profile=profile.id
              and c.user=u.id
            )
        )
    ");

    if (empty($query)) {
      return redirect()->route('not_exists_error');
    }

    $collaborator = User::where('id',$query['0']->id)->first(); 

    if( is_null ($collaborator) ) {
      return redirect()->route('not_exists_error');
    }
    if (! Hash::check($request->password,$collaborator->password)) {
      return redirect()->route('credentials_error');
    }
    else{
      Auth::login($collaborator);
      return redirect()->route('publication.list');
    }

  }

  /////////////////////////////////////////////////////////////////////////
  // Logout
  public function logout(Request $request){
    Auth::logout();
    return redirect()->route('welcome');
  }
}
