<?php

namespace App\Http\Controllers;
use App\Models\DimensionValue;

class ChartController extends Controller
{
  public function getAreaNasionalByYear($year)
  {
    $data = DimensionValue::getAreaNasionalByYear($year);
    $result = [];
     foreach ($data as $key => $value) {
     $result [] = array(
       'dimension_value' => $value['dimension_value'],
       'dimension_icon' => asset('/assets/img').'/'.$value['dimension_icon'],
       'dimension_name' => $value['dimension_name'],
       'dimension_id' => $value['dimension_id'],
     );
    }
    return response()->json($result, 200);
  }
}
