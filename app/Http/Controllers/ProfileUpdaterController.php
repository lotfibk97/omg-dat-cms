<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaborator;
use App\User;

class ProfileUpdaterController extends Controller
{
    public function update(ProfileUpdateRequest $request){
        if($request->type === 'profile'){

       $collaborator= User::where('email',$request->email)->where('type',$request->type)->first();

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
}
}
