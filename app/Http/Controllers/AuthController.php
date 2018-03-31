<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


  use Exception;
  use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
  use Illuminate\Foundation\Auth\ThrottlesLogins;
  use Illuminate\Support\Facades\Auth;
  use Laracarte\Http\Controllers\Controller;
  use Laracarte\User;
  use Socialite;
  use Validator;
  class AuthController extends Controller
  {
      /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
      */
      use AuthenticatesAndRegistersUsers, ThrottlesLogins;
      protected $redirectPath = '/login';
      /**
       * Create a new authentication controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          $this->middleware('guest', ['except' => 'getLogout']);
      }
      /**
       * Get a validator for an incoming registration request.
       *
       * @param  array  $data
       * @return \Illuminate\Contracts\Validation\Validator
       */
      protected function validator(array $data)
      {
          return Validator::make($data, [
              'name' => 'required|max:30|unique:users',
              'email' => 'required|email|max:255|unique:users',
              'password' => 'required|confirmed|min:6',

          ]);
      }

      protected function create(array $data)
      {
          return User::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
          ]);
      }

  

}
