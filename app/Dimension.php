<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
  protected $table = 'dimensions';
  protected $primaryKey = 'id';
  
  public static function getAll()
  {
    $data =  Dimension::get();
    return $data;
  }

  public static function getDimensi($slug)
  {
    $data =  Dimension::where('slug', $slug)->first();
    return $data;
  }
}
