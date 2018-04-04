<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMessageCreated;
use App\User;
use Illuminate\Support\Facades\Input;
use Hash;
use Validator;
use Illuminate\Container\Container;
use Illuminate\Mail\Markdown;
use Log;

class RegistrationController extends Controller
{

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
  public function confirmation($token){
    $user= User::where('token',$token)->first();

    if(!is_null($user)){
      $user->confirmed = 1;
      $user->token ='';
      $user->save();
      return redirect(route('login_admin'))->with('status','Your activation is completed.');
    }
    return redirect(route('login'))->with('status','something went wrong');

  }

    public function store(RegistrationRequest $request){
    //   $input= $request->all();
    //   $validator= $this->validator($input);
    //   if($validator->passes()){
    //     dd('a');
    //       $data= $this->create($input)->toArray();
    //
    //       $data['token']= str_random(25);
    //
    //       $user=User::find($data['id']);
    //       $user->token = $data['token'];
    //       $user->save();
    //
    //       Mail::send('emails.message.created',$data,function($message) use($data){
    //           $message->to($data['email']);
    //           $message->subject('Registration confirmation');
    //       });
    //
    //       return redirect( route('login'))->with('status','Confirmation email has been send. Please check your email!');
    //   }
    //   return redirect( route('login'))->with('status', $validator->errors());
    // }
    //



      $input= $request->all();
      $data= $this->create($input)->toArray();
      $data['token']= str_random(25);
      $user=User::find($data['id']);
      $user->token = $data['token'];
      $user->save();
      $mailable = new UserMessageCreated($user->name,$user->email,$user->token);
// dd($data['token']);
      Mail::to($user['email'])->send($mailable);



      $name = $data['name'];
      $token = $data['token'];

      // $markdown = Container::getInstance()->make(Markdown::class);
      // $html = $markdown->render('emails.message.created', compact('name', 'token'));
      //
      //
      //       // this is your desired HTML
      //       Log::info('HTML -->  ' . $html);
    // });

      // $user = new User;
      // $user->email = Input::get('email');
      // $user->name = Input::get('username');
      // $user->password = Hash::make(Input::get('password'));
      // $user->save();

      flashy()->success('We will answer you.');

      return redirect( route('email'))->with('status','Confirmation email has been send. Please check your email!');
  }
 }
