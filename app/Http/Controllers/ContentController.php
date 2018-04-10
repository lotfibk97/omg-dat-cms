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
    $content=Content::create([
      'title' => $data["title"],
      'description' => $data["description"],
      'type' => $data["type"],
      'creator' => $user->id,
      'publication' => $publication->id,
    ]);

    if($content->type=="image") {
      $content->html="/static/images/default-pic.jpg";
      $content->save();
    }

    return redirect()->route('publication.manage',$pub);
  }

  public function ajax(Request $request) {

    $json=$request->all();
    $content=Content::where('id',$json["id"])->first();
    $publication=Publication::where('id',$content->publication)->first();
    $user=User::where('id',Auth::id())->first();

    // if admin user check that the publication belongs to him
    if ($user->type =='admin') {
      if ($publication->user != $user->id ) dd('not urs');
    }
    // if collaborator user check that he contributes as publicator in this pub
    else {
      $collaborator=Collaborator::where('profile',$user->id)->first();
      $collaboration=Collaboration::where('collaborator',$collaborator->id)->where('publication',$publication->id)->first();
      if(is_null($collaboration) || $collaboration->role != 'publicator') dd('u kent manage dis publication');
    }

    // save content updates
    $content->top=$json["top"];
    $content->left=$json["left"];
    $content->height=$json["height"];
    $content->width=$json["width"];
    $content->hcenter=$json["center-h"];
    $content->vcenter=$json["center-v"];
    $content->displayed=$json["displayed"];
    $content->save();
    // save publication updates
    $publication->rows=$json["rows"];
    $publication->scroll=$json["scroll"];
    $publication->selected=$json["id"];
    $publication->save();

  }


  public function update(Request $request , $cnt) {

    $content=Content::where('id',$cnt)->first();
    $publication=Publication::where('id',$content->publication)->first();
    $user=User::where('id',Auth::id())->first();

    // if admin user check that the publication belongs to him
    if ($user->type =='admin') {
      if ($publication->user != $user->id ) dd('not urs');
    }
    // if collaborator user check that he contributes as publicator in this pub
    else {
      $collaborator=Collaborator::where('profile',$user->id)->first();
      $collaboration=Collaboration::where('collaborator',$collaborator->id)->where('publication',$publication->id)->first();
      if(is_null($collaboration) || $collaboration->role != 'publicator') dd('u kent manage dis publication');
    }

    // update content
    $data=$request->all();
    $content->title=$data["title"];
    $content->description=$data["description"];
    $content->type=$data["type"];
    $content->save();

    return redirect()->route('publication.manage',$publication->id);
  }


  public function delete(Request $request) {

    $json=$request->all();
    $content=Content::where('id',$json["id"])->first();
    $publication=Publication::where('id',$content->publication)->first();
    $user=User::where('id',Auth::id())->first();

    // if admin user check that the publication belongs to him
    if ($user->type =='admin') {
      if ($publication->user != $user->id ) dd('not urs');
    }
    // if collaborator user check that he contributes as publicator in this pub
    else {
      $collaborator=Collaborator::where('profile',$user->id)->first();
      $collaboration=Collaboration::where('collaborator',$collaborator->id)->where('publication',$publication->id)->first();
      if(is_null($collaboration) || $collaboration->role != 'publicator') dd('u kent manage dis publication');
    }

    // delete content and set null selected item for the publication
    $content->delete();
    $publication->selected=null;

  }

  public function fill(Request $request, $cnt) {
        // dd($request);

        $content = Content::where('id',$cnt)->first();
        if($content->type === 'text'){
        $content->html = $request->html;
        $content->save();
        return redirect()->route('publication.list');
        }
        if($content->type === 'image'){
          if(isset($request->all()['image'])){
            $image = $request->all()['image'];
            // dd($request->all()['image']);
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/static/images');
            $image->move($destinationPath, $input['imagename']);
            $pos = strpos($destinationPath, "static");
            $endpoint = $pos + strlen("static");
            $destinationPath = "/static".substr($destinationPath,$endpoint)."/".$input['imagename'];
            $content->html = $destinationPath;
            $content->save();
            return redirect()->route('publication.list');
          }
        }
        if($content->type === 'video'){
        // dd($request->url);
          $content->html = $request->url;
          $content->save();
          return redirect()->route('publication.list');

        }
        if($content->type === 'audio') {
          $content->html = $request->url;
          $content->save();
          return redirect()->route('publication.list');
        }




  }

}
