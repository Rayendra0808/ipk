<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
  protected $table = 'provinces';
  protected $primaryKey = 'id';
  
  public static function getAll()
  {
    $data =  Province::get();
    return $data;
  }

  public static function getProvince($id)
  {
    $data =  Province::where('id', $id)->first();
    return $data;
  }
}
