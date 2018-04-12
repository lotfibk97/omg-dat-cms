<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaborator;
use App\User;
use App\Http\Requests\ProfileUpdateRequest;
use Auth;
use Storage;
use Illuminate\Support\Facades\Input;
use Hash;

class ProfileUpdaterController extends Controller
{

  /////////////////////////////////////////////////////////////////////////
  // Profile Update Post
  public function modification(Request $request){

    $user =User::where('id',Auth::id())->first();
    $data = [
        'user' => $user,
        'title' => 'profiles',
    ];
    return view('auth/profile',$data);

  }

  /////////////////////////////////////////////////////////////////////////
  // Profile Update Post
  public function update(ProfileUpdateRequest $request){

    $user = User::where('id',Auth::id())->first();

    $collaborator= User::where('email',$user->email)->first();

    if(is_null($collaborator)) dd("aaa");

    if( Hash::check($request->password,$collaborator->password)) {

      $destinationPath=$collaborator->picture;

      if(isset($request->all()['image'])){
        $image = $request->all()['image'];
        $input['imagename'] = 'P'.$user->id.'_'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/static/images');
        $image->move($destinationPath, $input['imagename']);
        $pos = strpos($destinationPath, "static");
        $endpoint = $pos + strlen("static");
        $destinationPath = "/static".substr($destinationPath,$endpoint)."/".$input['imagename'];
        $collaborator->picture = $destinationPath;
      }

      if(!is_null($request->email)) $collaborator->email = $request->email;
      if(!is_null($request->name)) $collaborator->name = $request->name;
      if(!is_null($request->password1)) $collaborator->password = Hash::make($request->password1);

      $collaborator->save();

      return redirect()->route('profile.update');

    }

    return redirect()->route('credentials_error');

  }


}
