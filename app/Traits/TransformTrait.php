<?php

namespace App\Traits;

trait TransformTrait
{
  public function dimensionValueToChartResponse($data)
  {
    $data = $data->toArray();
    $result = [];
    foreach ($data as $keyDimension => $value) {
      $result[] = array(
        'dimension_icon' => asset('/assets/img') . '/' . $value['dimension_icon'],
        'dimension_name' => $value['dimension_name'],
        'dimension_id' => $value['id'],
        'dimension_value' => 0,
      );
      foreach ($value['dimension_values'] as $dimensionValue ) {
        $result[$keyDimension]['dimension_value'] = $dimensionValue['dimension_value'];
      }
    }
    return $result;
  }

  public function dimensionTotalValueToChartResponse($data)
  {
    $result = ['total' => $data->total, 'year'=> $data->year];
    return $result;
  }
}
