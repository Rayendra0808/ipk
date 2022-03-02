<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimensionTotalValueProvince extends Model
{
  protected $table = 'dimension_total_value_provinces';
  protected $primaryKey = 'id';


  public static function getTotal($year, $provinceId)
  {
    $data =  DimensionTotalValueProvince::where('province_id', $provinceId)
      ->where('year', $year)
      ->first();
    return $data;
  }
}
