<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMessageCreated;
use App\User;
use Illuminate\Support\Facades\Input;
use Hash;


class RegistrationController extends Controller
{



    public function store(RegistrationRequest $request){
      $user = new User;
      $user->email = Input::get('email');
      $user->name = Input::get('username');
      $user->password = Hash::make(Input::get('password'));
      $user->save();
      $mailable = new UserMessageCreated($request->name,$request->email);
      Mail::to('admin@odc.com')->send($mailable);

      flashy()->success('We will answer you.');

      return redirect('welcome');
  }
}
