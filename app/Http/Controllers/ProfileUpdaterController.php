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
    public function update(ProfileUpdateRequest $request){
// dd('a');
$user = User::where('id',Auth::id())->first();
// dd($user->type);

// // dd('a');
         $collaborator= User::where('email',$user->email)->first();
//
         if(!is_null($collaborator)){
        if( Hash::check($request->password,$collaborator->password)) {
            $destinationPath=$collaborator->picture;
          if(isset($request->all()['image'])){
       $image = $request->all()['image'];
// dd( Input::file('image')->getClientOriginalExtension());

       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
       $destinationPath = public_path('/static/images');
       $image->move($destinationPath, $input['imagename']);
       $destinationPath = $destinationPath.'/'.$image;
       $collaborator->picture = $destinationPath;
         // $url = $request->all()['image'];
         // $contents = file_get_contents($url);
         // $name = substr($url, strrpos($url, '/') + 1);
         // Storage::put($name, $contents);
        // dd('a');
      }
          if(!is_null($request->email)){
         $collaborator->email = $request->email;
       }
         if(!is_null($request->name)){
         $collaborator->name = $request->name;
       }
       if(!is_null($request->password1)){
         $collaborator->password = Hash::make($request->password1);
      }
         $collaborator->save();

         return redirect()->route('profile.update')->with([
           'path' => $destinationPath
         ]);
}
else{
  return redirect()->route('credentials_error');
}
}
}
}
