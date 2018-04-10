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
        if($user->type === 'profile'){
// // dd('a');
         $collaborator= User::where('email',$user->email)->first();
//
         if(!is_null($collaborator)){
//
       $image = $request->all()['image'];
// dd( Input::file('image')->getClientOriginalExtension());
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

       $destinationPath = public_path('/static/images');

       $image->move($destinationPath, $input['imagename']);

         // $url = $request->all()['image'];
         // $contents = file_get_contents($url);
         // $name = substr($url, strrpos($url, '/') + 1);
         // Storage::put($name, $contents);

         $collaborator->email = $request->email;
         $collaborator->name = $request->name;
         $collaborator->password = Hash::make($request->password);
         $collaborator->save();
         return redirect()->route('profile.update');
}

    }
    else{dd('b');
}}
}
