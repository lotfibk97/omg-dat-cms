<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Collaboration;
use App\Models\Collaborator;
use App\User;
use App\Http\Requests\PublicationRequest;
use Auth;

class PublicationController extends Controller
{
    // create new publication controller
    public function create(PublicationRequest $request){

      $user = User::where('id',Auth::id())->first();

      if($user->type != 'admin') dd('u kent');
      $pub=Publication::create([
          'title' => $request->title,
          'description' => $request->description,
          'user' => Auth::id(),
      ]);
      $pub->url = str_replace(' ', '', $user->name.'/'.$pub->id);
      $pub->save();
      $input = $request->toArray();

      foreach ($input as $key => $value) {
        if(substr($key,0,6) === 'collab'){
          $collaboration=Collaboration::create([
              'role' => $value,
              'collaborator' => Collaborator::where('profile',substr($key,6))->first()->id,
              'publication' => $pub->id,
          ]);
        }
      }
      return redirect()->route('publication.list');

    }


    // update an existing publication controller
    public function update(PublicationRequest $request, $pub){

      $user = User::where('id',Auth::id())->first();
      $publication = Publication::where('id',$pub)->first();

      if(is_null($publication->id)) redirect()->route('error1');
      if($publication->user != $user->id) dd('u kent');
      if($publication->type != 'admin') dd('u kent');

      $publication->title=$request->title;
      $publication->description=$request->description;

      $input = $request->toArray();

      foreach ($input as $key => $value) {
        if(substr($key,0,6) === 'collab'){
          $collaboration=Collaboration::where('collaborator',substr($key,0,6))
                                      ->where('publication',$pub);
          ;

          dd($value);
          $collaboration->$role=$value->role;
        }
      }

    }
}
