<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaborator;

class ProfileUpdaterController extends Controller
{
    public function update(ProfileUpdateRequest $request){
       $collaborator= Collaborator::where('email',$request->email)->where('user',$request->user)->first();
         if(!is_null($user)){

       $image = $request->file('image');

       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

       $destinationPath = public_path('/static/images');

       $image->move($destinationPath, $input['imagename']);
}

    }
}
