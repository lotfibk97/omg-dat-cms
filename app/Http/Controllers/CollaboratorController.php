<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\User;
use Auth;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
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
