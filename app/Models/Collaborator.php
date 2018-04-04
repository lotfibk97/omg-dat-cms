<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
  public function is_validated(){
      if($this->confirmed){
        return true;
      }
    return false;
  }
}
