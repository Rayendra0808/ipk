<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimensionValue extends Model
{
  protected $table = 'dimension_values';
  protected $primaryKey = 'id';

  public function province(){
    return $this->belongsTo(Province::class);
  }

  public function dimension(){
    return $this->belongsTo(Dimension::class);
  }

  public static function getDimensionProvince($param)
  {
    if (!$param->input('year')) return [];
    $condition = [];
    $orderBy = ['dimension_values.dimension_value', 'desc'];
    if ($year = $param->input('year')) $condition[]=['year', $year];
    if ($dimensionId = $param->input('dimension_id')) $condition[]=['dimension_id', $dimensionId];
    if ($provinceId = $param->input('province_id')) {
      $condition[]=['province_id', $provinceId];
      if($provinceId!='1001'){
        $orderBy = ['dimension_values.dimension_id', 'asc'];
      }
    }

    $data = DimensionValue::with(['province'=>function($q) use ($param) {
      if($provinceId = $param->input('province_id')) $q->where('provinces.id', $provinceId);
    }, 'dimension'])
      // ->where('dimension_values.year', $param->input('year'))
      // ->where('dimension_values.dimension_id', $param->input('dimension_id'))
      ->where($condition)
      ->orderBy($orderBy[0], $orderBy[1])
      ->get();
    return $data;
  }
}
