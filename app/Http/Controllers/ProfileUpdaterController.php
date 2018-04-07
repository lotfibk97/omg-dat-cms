<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaborator;
use App\User;
use App\Http\Requests\ProfileUpdateRequest;
use Auth;


class ProfileUpdaterController extends Controller
{
    public function update(ProfileUpdateRequest $request){
// dd('a');
$user = User::where('id',Auth::id())->first();
dd($user);
        if($user->getType() === 'profile'){
// dd('a');
       $collaborator= User::where('email',$user->getEmail())->first();

         if(!is_null($collaborator)){

       $image = $request->file('image');

       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

       $destinationPath = public_path('/static/images');

       $image->move($destinationPath, $input['imagename']);

       $collaborator->email = $request->email;
       $collaborator->name = $request->name;
       $collaborator->password = $request->password;
       $collaborator->save();
}

    }
    else{dd('b');
}}
}
