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
use File;
use DB;
use App\Models\Menu;


class ContentController extends Controller
{
  //////////////////////////////////////////////////////////////////////////
  // Create Content POST
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
    if($content->type==="menu"){
      $menu=Menu::create([
      'content_id' => $content->id,
      ]);
    }
    return redirect()->route('publication.manage',$pub);
  }

  //////////////////////////////////////////////////////////////////////////
  // Update Content Position with ajax post
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

  //////////////////////////////////////////////////////////////////////////
  // Update Content POST
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

  //////////////////////////////////////////////////////////////////////////
  // Delete Content POST
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

  //////////////////////////////////////////////////////////////////////////
  // Fill Content Get
  public function filling(Request $request, $cnt) {

    $content=Content::where('id',$cnt)->first();
    $data= [
      'title' => $content->title,
      'content' => $content,
    ];

    if($content->type=="text")
    return view('contents/text',$data);

    if($content->type=="image")
    return view('contents/image',$data);

    if($content->type=="audio")
    return view('contents/audio',$data);

    if($content->type=="video")
    return view('contents/video',$data);

    if($content->type==='menu')
    return view('contents/menu',$data);

  }

  //////////////////////////////////////////////////////////////////////////
  // Fill Content POST
  public function fill(Request $request, $cnt) {

    $content = Content::where('id',$cnt)->first();

    if($content->type === 'text'){
      $content->html = $request->html;
      $content->save();
      return redirect()->route('content.fill',$cnt);
    }

    if($content->type === 'image'){
      if(isset($request->all()['image'])){

        $blog = User::where('id',Auth::id())->first();
        if ($blog->type=="admin") $id=$blog->id;
        else $id=Collaborator::where('profile',$blog->id)->first()->user;
        $blog = User::where('id',$id)->first();

        $image = $request->all()['image'];
        $input['imagename'] = 'B'.$id.'_'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/static/images');
        $image->move($destinationPath, $input['imagename']);
        $pos = strpos($destinationPath, "static");
        $endpoint = $pos + strlen("static");
        $destinationPath = "/static".substr($destinationPath,$endpoint).'/'.$input['imagename'];
        $content->html = $destinationPath;
        $content->save();

        return redirect()->route('content.fill',$cnt);

      }

      else {

        $all=File::allFiles(Public_path()."/static/images");
        $images=array();
        $exists=false;
        foreach($all as $image) {
          $pos = strpos($image->getPathname(), "static");
          $endpoint = $pos + strlen("static");
          $destinationPath = "/static".substr($image->getPathname(),$endpoint);
          if($destinationPath===$request->all()['imagename'])
          $exists=true;
        }

        if($exists) {
          $content->html=$request->all()['imagename'];
          $content->save();
        } else {
          $content->html='/static/images/default-pic.png';
          $content->save();
        }

        return redirect()->route('content.fill',$cnt);
      }

    }

    if($content->type === 'video'){
      $content->html = $request->url;
      $content->save();
      return redirect()->route('content.fill',$cnt);
    }

    if($content->type === 'audio') {
      $content->html = $request->url;
      $content->save();
      return redirect()->route('content.fill',$cnt);
    }
    if($content->type === 'menu') {



      return redirect()->route('content.fill',$cnt);
    }
  }

  //////////////////////////////////////////////////////////////////////////
  // Text Contents List
  public function textList(Request $request) {

    $user = User::where('id',Auth::id())->first();
    if($user->type == 'admin')
    $contents=DB::select("
        select c.* from contents c , publications p
        where c.publication=p.id
        and p.user=".Auth::id()."
        and c.type=\"text\"
    ");
    else {
    $contents=DB::select("
        select c.* from contents c
        where c.type=\"text\"
        and exists (
            select * from collaborations cb, collaborators cl
            where cb.publication=c.publication
            and cb.collaborator=cl.id
            and cl.profile=".$user->id."
            and ( cb.role=\"editor\" or cb.role=\"publicator\" )
        )
    ");
    }

    // adding publication title
    foreach($contents as $content) {
      $content->publication=DB::select("
          select title from publications
          where id=".$content->publication."
      ")[0]->title;
    }
    // adding creator name
    foreach($contents as $content) {
      $content->creator=User::where('id',$content->creator)->first()->name;
    }

    $data= [
      'title' => 'Text Contents',
      'contents' => $contents,
      'type' =>"text",
    ];
    return view('contents/cntList',$data);

  }

  //////////////////////////////////////////////////////////////////////////
  // Image Contents List
  public function imageList(Request $request) {

    $user = User::where('id',Auth::id())->first();
    if($user->type == 'admin')
    $contents=DB::select("
        select c.* from contents c , publications p
        where c.publication=p.id
        and p.user=".Auth::id()."
        and c.type=\"image\"
    ");
    else {
    $contents=DB::select("
        select c.* from contents c,publications p
        where c.publication=p.id
        and c.type=\"image\"
        and exists (
            select * from collaborations cb, collaborators cl
            where cb.publication=p.id
            and cb.collaborator=cl.id
            and cl.profile=".$user->id."
            and ( cb.role=\"editor\" or cb.role=\"publicator\" or cb.role=\"media-manager\" )
        )
    ");
    }

    // adding publication title
    foreach($contents as $content) {
      $content->publication=DB::select("
          select title from publications
          where id=".$content->publication."
      ")[0]->title;
    }
    // adding creator name
    foreach($contents as $content) {
      $content->creator=User::where('id',$content->creator)->first()->name;
    }

    $data= [
      'title' => 'Image Contents',
      'contents' => $contents,
      'type' =>"image",
    ];
    return view('contents/cntList',$data);

  }

  //////////////////////////////////////////////////////////////////////////
  // Audio Contents List
  public function audioList(Request $request) {

    $user = User::where('id',Auth::id())->first();
    if($user->type == 'admin')
    $contents=DB::select("
        select c.* from contents c , publications p
        where c.publication=p.id
        and p.user=".Auth::id()."
        and c.type=\"audio\"
    ");
    else {
    $contents=DB::select("
        select c.* from contents c,publications p
        where c.publication=p.id
        and c.type=\"audio\"
        and exists (
            select * from collaborations cb, collaborators cl
            where cb.publication=p.id
            and cb.collaborator=cl.id
            and cl.profile=".$user->id."
            and ( cb.role=\"editor\" or cb.role=\"publicator\" or cb.role=\"media-manager\" )
        )
    ");
    }

    // adding publication title
    foreach($contents as $content) {
      $content->publication=DB::select("
          select title from publications
          where id=".$content->publication."
      ")[0]->title;
    }
    // adding creator name
    foreach($contents as $content) {
      $content->creator=User::where('id',$content->creator)->first()->name;
    }

    $data= [
      'title' => 'Audio Contents',
      'contents' => $contents,
      'type' =>"audio",
    ];
    return view('contents/cntList',$data);

  }

  //////////////////////////////////////////////////////////////////////////
  // Video Contents List
  public function videoList(Request $request) {

    $user = User::where('id',Auth::id())->first();
    if($user->type == 'admin')
    $contents=DB::select("
        select c.* from contents c , publications p
        where c.publication=p.id
        and p.user=".Auth::id()."
        and c.type=\"video\"
    ");
    else {
    $contents=DB::select("
        select c.* from contents c,publications p
        where c.publication=p.id
        and c.type=\"video\"
        and exists (
            select * from collaborations cb, collaborators cl
            where cb.publication=p.id
            and cb.collaborator=cl.id
            and cl.profile=".$user->id."
            and ( cb.role=\"editor\" or cb.role=\"publicator\" or cb.role=\"media-manager\" )
        )
    ");
    }

    // adding publication title
    foreach($contents as $content) {
      $content->publication=DB::select("
          select title from publications
          where id=".$content->publication."
      ")[0]->title;
    }
    // adding creator name
    foreach($contents as $content) {
      $content->creator=User::where('id',$content->creator)->first()->name;
    }

    $data= [
      'title' => 'Video Contents',
      'contents' => $contents,
      'type' =>"video",
    ];
    return view('contents/cntList',$data);

  }

  //////////////////////////////////////////////////////////////////////////
  // BLOG's Static Files Managment
  // for the moment it displays all the static files for all the blogs
  public function static(Request $request) {

    $blog = User::where('id',Auth::id())->first();
    if ($blog->type=="admin") $id=$blog->id;
    else $id=Collaborator::where('profile',$blog->id)->first()->user;
    $blog = User::where('id',$id)->first();

    $all=File::allFiles(Public_path()."/static/images");
    $images=array();

    foreach($all as $image) {
      if($image->getFilename(){0}==='B') {
        $pos = strpos($image->getPathname(), "static");
        $endpoint = $pos + strlen("static");
        $destinationPath = "/static".substr($image->getPathname(),$endpoint);
        array_push($images,$destinationPath);
      }
    }

    $audios=DB::select("
        select c.* from contents c , publications p
        where c.publication=p.id
        and c.type='audio'
        and p.user=".$id."
    ");

    $data = [
        'title' => 'Static Files',
        'images' => $images,
        'audios' => $audios,
    ];

    return view('contents/files',$data);

  }

}
