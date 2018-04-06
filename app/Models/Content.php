<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  protected $fillable = ['title','description','type','publication','creator',
    'html','top','left','width','height','center-h','center-v','displayed'
  ];
}
