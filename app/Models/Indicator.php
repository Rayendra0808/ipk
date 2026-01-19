<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
  protected $table = 'indicators';
  protected $primaryKey = 'id';

  public function indicatorValues(){
    return $this->hasMany(IndicatorValue::class);
  }

  public function indicatorTargetValues(){
    return $this->hasMany(IndicatorTargetValue::class);
  }
  
  public static function getAll()
  {
    $data = Indicator::get();
    return $data;
  }

  public static function getIndicatorValues($param){
    $query = Indicator::with(['indicatorValues' => function($q) use ($param) {
      if($year = $param->input('year')) $q->where('year', $year);
      if($provinceId = $param->input('province_id')) $q->where('province_id', $provinceId);
    },'indicatorTargetValues' => function($q) use ($param) {
      $q->where('year', '2024');
      if($provinceId = $param->input('province_id')) $q->where('province_id', $provinceId);
    }])
    ->where('dimension_id', $param->input('dimension_id'));

    if($param->input('year') == 2024){
        $query->whereIn('id', config('app.indicator.2024'));
    } else {
        $query->whereIn('id', config('app.indicator.2023'));
    }

    $data = $query->get();

    return $data;
  }
}
