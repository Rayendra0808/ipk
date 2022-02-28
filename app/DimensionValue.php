<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DimensionValue extends Model
{
  protected $table = 'dimension_values';
  protected $primaryKey = 'id';
  
  public static function getAll()
  {
    $data =  DimensionValue::get();
    return $data;
  }

  public static function getAreaNasionalByYear($year)
  {
    $data =  DimensionValue::where('year', $year)->where('province_id', '1001')->get();
    return $data;
  }
}
