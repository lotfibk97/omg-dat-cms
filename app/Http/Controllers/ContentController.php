<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Collaboration;
use App\Models\Collaborator;
use App\Models\Content;
use App\User;
use App\Http\Requests\PublicationRequest;
use Auth;


class ContentController extends Controller
{

  public function create(Request $request, $pub) {

    $publication=Publication::where('id',$pub)->first();
    $user=User::where('id',Auth::id())->first();

    // if admin user check that the publication belongs to him
    if ($user->type =='admin') {
      if ($publication->user != $user->id ) dd('not urs');
    }
    // if collaborator user check that he contributes as publicator in this pub
    else {
      $collaborator=Collaborator::where('profile',$user->id)->first();
      $collaboration=Collaboration::where('collaborator',$collaborator->id)->where('publication',$pub)->first();
      if(is_null($collaboration) || $collaboration->role != 'publicator') dd('u kent manage dis publication');
    }

    // create the content
    $data=$request->all();
    if(!$data['type']) dd('choose type');
    Content::create([
      'title' => $data["title"],
      'description' => $data["description"],
      'type' => $data["type"],
      'creator' => $user->id,
      'publication' => $publication->id,
    ]);

    return redirect()->route('publication.manage',$pub);
  }

  public function ajax(Request $request, $pub) {
    //dd($request);
    return redirect()->route('error1');
  }

}
