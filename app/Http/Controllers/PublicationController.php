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

      // check for admin account
      $user = User::where('id',Auth::id())->first();
      if($user->type != 'admin') dd('u kent');

      // create publication from request data
      $pub=Publication::create([
          'title' => $request->title,
          'description' => $request->description,
          'user' => Auth::id(),
      ]);
      $pub->url = str_replace(' ', '', $user->name.'/'.$pub->id);
      $pub->save();

      // create collaborations from request data
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

      // redirection to publications list
      return redirect()->route('publication.list');
    }


    ///////////////////////////////////////////////////////////////////////////
    // update an existing publication controller
    public function update(PublicationRequest $request, $pub){

      // check for user admin and its possession of publication
      $user = User::where('id',Auth::id())->first();
      $publication = Publication::where('id',$pub)->first();
      if(is_null($publication->id)) redirect()->route('error1');
      if($publication->user != $user->id) dd('not owner');
      if($user->type != 'admin') dd('u kent');

      // update title & desc
      $publication->title=$request->title;
      $publication->description=$request->description;
      $publication->save();

      // update role for collaborators
      $input = $request->toArray();
      foreach ($input as $key => $value) {
        if(substr($key,0,6) === 'collab'){
          $collab=Collaborator::where('profile',substr($key,6))->first();
          $collaboration=Collaboration::where('collaborator',$collab->id)
                                     ->where('publication',$pub)->first();
          ;
          $collaboration->role=$value;
          $collaboration->save();
        }
      }

      // return back to publication edit
      return redirect()->route('publication.update',['pub'=>$publication->id]);
    }

    ///////////////////////////////////////////////////////////////////////////
    // delete publication controller
    public function delete(Request $request, $pub){

      // check for user admin and its possession of publication
      $user = User::where('id',Auth::id())->first();
      $publication = Publication::where('id',$pub)->first();
      if(is_null($publication->id)) redirect()->route('error1');
      if($publication->user != $user->id) dd('not owner');
      if($user->type != 'admin') dd('u kent');

      // delete the publication
      $publication->delete();

      // redirect to publications list
      return redirect()->route('publication.list');
    }

}
