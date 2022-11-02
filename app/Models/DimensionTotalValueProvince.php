<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimensionTotalValueProvince extends Model
{
  protected $table = 'dimension_total_value_provinces';
  protected $primaryKey = 'id';

  public function province()
  {
    return $this->belongsTo(Province::class);
  }

  public static function getTotal($year, $provinceId)
  {
    $data =  DimensionTotalValueProvince::where('province_id', $provinceId)
      ->where('year', $year)
      ->first();
    return $data;
  }

  public static function getDimensionTotalProvince($param)
  {
    $condition = [];
    if ($year = $param->input('year')) $condition[] = ['year' => $year];
    if ($province = $param->input('province_id')) $condition[] = ['province_id' => $province];
    $data = DimensionTotalValueProvince::with('province')->where([$condition])->get();
    return $data;
  }

  public static function getDimensionTotal($provinceId)
  {
    $dataNasional = DimensionTotalValueProvince::with('province')->where('province_id', 1001)->get();
    $dataProvince = DimensionTotalValueProvince::with('province')->where('province_id', $provinceId)->get();
    $data = [];
    $dataNasional = $dataNasional->toArray();
    $dataProvince = $dataProvince->toArray();
    foreach ($dataNasional as $keyNasional => $value) {
      $data[$value['year']][] = array($value['province']['province_name'] => $value['total']);
    }
    foreach ($dataProvince as $keyProvince => $valueProvince) {
      $data[$valueProvince['year']][] = array($valueProvince['province']['province_name'] => $valueProvince['total']);
    }
    return $data;
  }
}
