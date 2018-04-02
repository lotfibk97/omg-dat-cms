<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{


    // protected $redirectTo = '/home';


    public function check(Request $request){
 // dd($request->all());
// dd(Auth::attempt());
    if(Auth::attempt([
        'email' => $request->email,
        'password' => $request->password,
    ])){

          $user = User::where('email',$request->email)->first();
          if($user->is_validated()){
            return redirect()->route('dashboard');
          }
          $request->session()->flush();
          return redirect()->route('error1');
         }
else{
echo "you are not registred";

}


    }
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}
