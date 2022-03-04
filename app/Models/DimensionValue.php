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
    if (!$param->input('year') || !$param->input('dimension_id')) return [];
    $condition = [];
    $data = DimensionValue::with(['province', 'dimension'])
      ->where('dimension_values.year', $param->input('year'))
      ->where('dimension_values.dimension_id', $param->input('dimension_id'))
      ->orderBy('dimension_values.dimension_value', 'desc')
      ->get();
    return $data;
  }
}
