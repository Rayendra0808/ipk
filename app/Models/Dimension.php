<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Dimension extends Model
{
  protected $table = 'dimensions';
  protected $primaryKey = 'id';

  public function dimensionQualities()
  {
    return $this->hasMany(DimensionQuality::class);
  }

  public function dimensionIndicators()
  {
    return $this->hasMany(Indicator::class);
  }

  public function dimensionValues()
  {
    return $this->hasMany(DimensionValue::class);
  }

  public static function getAll()
  {
    $data =  Dimension::get();
    return $data;
  }

  public static function getDimension($slug)
  {
    $data =  Dimension::where('dimension_slug', $slug)->first();
    return $data;
  }

  public static function getYear()
  {
    return ['2020', '2019', '2018'];
  }

  public static function getDimensionData($year, $provinceId)
  {
    $data = Dimension::with(['dimensionValues' => function ($q) use ($provinceId, $year) {
      $q->where('dimension_values.province_id', $provinceId)
        ->where('dimension_values.year', $year);
    }, 'dimensionQualities'])
      ->get();
    return $data;
  }

  public static function getDimensionWithIndicator($slug)
  {
    $data =  Dimension::with(['dimensionQualities', 'dimensionIndicators'])->where('dimension_slug', $slug)->first();
    return $data;
  }
}
