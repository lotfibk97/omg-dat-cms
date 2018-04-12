<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
  ////////////////////////////////////////////////////////////////////////////
  // Collaborators List
  public function list(Request $request) {

    $user = User::where('id',Auth::id())->first();
    if ($user->type =="profile") dd("wech dekhlek fihom");

    $collabs=DB::select("
        select * from users u
        where type='profile'
        and exists (
          select * from collaborators cl
          where cl.profile=u.id
          and cl.user=".$user->id."
          )
    ");

    $data = [
        'title' => 'collaborators',
        'collabs' => $collabs,
    ];

    return view('collaborators/clbList',$data);

  }


  ////////////////////////////////////////////////////////////////////////////
  // Collaborators delete form
  public function delete(Request $request, $collab) {

    $user=User::where('id',Auth::id())->first();
    if($user->type == "profile") dd("u kent");

    $collaborator=Collaborator::where('profile',$collab)->first();
    if(is_null($collaborator)) return redirect()->route('error3');

    if($collaborator->user != $user->id) return redirect()->route('error3');

    try {
      $profile=User::where('id',$collaborator->profile);
      $collaborator->delete();
      $profile->delete();
    } catch (\Illuminate\Database\QueryException $e) {
      dd("This collab has created some contents, duplicate them and delete them before you delete his account");
    }

    return redirect()->route('collaborator.list');
  }
}
