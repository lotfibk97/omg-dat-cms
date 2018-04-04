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
      return redirect()->route('dashboard');

    }

    // collaborator login

    $collaborator = DB::connection()->getPdo()->quote("
      select * from users profile where exists
        ( select * from collaborators collab
          where collab.profile=profile.id
          and ". $request->email." =
          ( select email from users admin
            where admin.id = collab.user )
        )
    ");

    if( is_null ($collaborator) ) {
      return redirect()->route('not_exists_error');
    }
    if (! Hash::check($request->password,$collaborator->password)) {
      return redirect()->route('credentials_error');
    }
    else{
      Auth::login($user);
      return redirect()->route('dashboard');
    }


  }
}
