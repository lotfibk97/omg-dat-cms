<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
  protected $fillable =['profile','user'];


  public function is_validated(){
      if($this->confirmed){
        return true;
      }
    return false;
  }
}
