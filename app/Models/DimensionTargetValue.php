<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimensionTargetValue extends Model
{
  protected $table = 'dimension_target_values';
  protected $primaryKey = 'id';

  public function province(){
    return $this->belongsTo(Province::class);
  }
  public function dimension(){
    return $this->belongsTo(Dimension::class);
  }

  public static function getDimensionProvinceTarget($param)
  {
    if (!$param->input('year') && !$param->input('dimension_id')) return [];
    $condition = [];
    if ($year = $param->input('year')) $condition[] = ['year' => '2024'];
    if ($dimensionId = $param->input('dimension_id')) $condition[] = ['dimension_id' => $dimensionId];

    $data = DimensionTargetValue::with(['province', 'dimension'])->where([$condition])->orderBy('dimension_target_value', 'desc')->get();
    return $data;
  }
}
