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
    public function create(PublicationRequest $request){
// dd(Collaborator::where('profile',6)->first()->id);
      $user = User::where('id',Auth::id())->first();
// dd(substr('twilabezzaf', 4 ));
      if($user->type != 'admin') dd('u kent');
      $pub=Publication::create([
          'title' => $request->title,
          'description' => $request->description,
          'user' => Auth::id(),
      ]);

      $input = $request->toArray();
// dd($input);
      foreach ($input as $key => $value) {
        # code...
        if(substr($key,0,6) === 'collab'){

          $pub=Collaboration::create([
              'role' => $value,
              'collaborator' => Collaborator::where('profile',substr($key,6))->first()->id,
              'publication' => $pub->id,
          ]);
        }
      }
      return redirect()->route('publication.list');

    }
}
