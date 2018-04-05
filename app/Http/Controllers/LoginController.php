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
    $collaborator = User::where('id',$query['0']->id)->first();
    // dd($collaborator);
      //
      // $collaborator = DB::table('users')
      //                 ->where('type','profile')
      //                 ->where('email',$request->email)
      //                 ->whereExists(function($query,$request){
      //                   $query->select(DB::raw(1))
      //                   ->from('users','u')
      //                   ->where('u.email',$request->admin)
      //                   ->whereExists(function($q){
      //                     $q->select(DB::raw(1))
      //                     ->from('collaborators','c')
      //                     ->whereRaw('c.profile = users.id')
      //                     ->whereRaw('c.user = u.id');
      //                   });
      //                 })($request)->get();


    // dd($collaborator);

    if( is_null ($collaborator) ) {
      return redirect()->route('not_exists_error');
    }
    if (! Hash::check($request->password,$collaborator->password)) {
      return redirect()->route('credentials_error');
    }
    else{
      Auth::login($collaborator);
      return redirect()->route('dashboard');
    }


  }
}
