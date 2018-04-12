<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Mail\UserMessageCreated;
use App\User;
use DB;
use Auth;
use App\Models\Publication;
use App\Models\Collaboration;
use App\Models\Collaborator;
use App\Models\Content;

class GlobalController extends Controller
{
    // controller for domain name route
    public function root(Request $request) {
      if(Auth::check())
      {
        return redirect()->route('publication.list');
      }
      return redirect()->route('welcome');
    }

    // controller for welcome page
    public function welcome(Request $request) {
      return view('layouts/welcome');
    }

    // controller for blog page
    public function blog(Request $request, $user) {

      $blog = User::where('id',$user)->first();
      if ($blog->type=="admin") $id=$blog->id;
      else $id=Collaborator::where('profile',$blog->id)->first()->user;
      $blog = User::where('id',$id)->first();

      $publications = DB::select("
          select * from publications where user=".$id."
      ");

      $collabs = DB::select("
          select * from collaborators where user=".$id."
      ");

      $data = [
        "title" => $blog->name."'s blog",
        "blog" => $blog,
        "publications" => $publications,
        "collabs" => $collabs,
      ];

      return view('layouts/blog',$data);

    }
}
