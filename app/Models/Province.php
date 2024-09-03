<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
  protected $table = 'provinces';
  protected $primaryKey = 'id';

  public static function getAll()
  {
    $data =  Province::where('id', '!=', '1001')->with(['files' => function($q){
      return $q->orderBy('title', 'ASC');
    }])->get();
    return $data;
  }

  public static function getProvince($id)
  {
    $data =  Province::where('id', $id)->with(['files' => function($q){
      return $q->orderBy('title', 'ASC');
    }])->first();
    return $data;
  }

  public function files()
  {
    return $this->hasMany('App\Models\ProvinceFile');
  }
}
