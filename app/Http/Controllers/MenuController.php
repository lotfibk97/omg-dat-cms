<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Menu;
use App\Models\Link;

class MenuController extends Controller
{
    // Goto Edit Menu Page
    public function edit(Request $request) {

      $user=Auth::user();
      if( is_null($user)) return redirect()->route('access_denied');
      if( $user->type != "admin") return redirect()->route('access_denied');

      $menu = Menu::where('admin_id',$user->id)->first();
      $links = DB::select("select * from links where menu_id=".$menu->id);
// dd($menu);
      $data = [
        'title' => "Menu Config",
        'menu' => $menu,
        'links' => $links,
      ];

      return view('contents/menu',$data);
    }


    // Recieve From Menu Page
    public function fill(Request $request) {

      $user=Auth::user();
      if( is_null($user)) return redirect()->route('welcome');
      if( $user->type != "admin") return redirect()->route('access_denied');

      $menu = Menu::where('admin_id',Auth::user()->id)->first();
      $menu->type = $request->types;

      if(isset($request->all()['image'])){
          $image = $request->all()['image'];
          $input['imagename'] = 'M'.$menu->id.'_'.time().'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/static/images');
          $image->move($destinationPath, $input['imagename']);
          $pos = strpos($destinationPath, "static");
          $endpoint = $pos + strlen("static");
          $destinationPath = "/static".substr($destinationPath,$endpoint).'/'.$input['imagename'];
          $menu->image = $destinationPath;
      }
      $menu->save();

      // delete all links
      $link=Link::where("menu_id",$menu->id)->first();
      while ($link) {
        $link->delete();
        $link=Link::where("menu_id",$menu->id)->first();
      }

      foreach ($request->all() as $key => $value) {
        if(preg_match('#link[0-9]$#',$key)) $name=$value;

        if(preg_match('#url[0-9]$#',$key)){
          $link= Link::create([
            'menu_id' => $menu->id,
            'url' => $value,
            'name' => $name,
          ]);
        }
      }
      $links = Link::where('menu_id',$menu->id)->get();
      $data = [
        'title' => "Menu Config",
        'menu' => $menu,
        'links' => $links,
      ];

      return view('/contents/menu',$data);

    }


}
