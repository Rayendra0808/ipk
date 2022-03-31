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
        $result[$keyDimension]['dimension_value'] = $this->decimalValue($dimensionValue['dimension_value']);
      }
    }
    return $result;
  }

  public function dimensionTotalValueToChartResponse($data)
  {
    $result = ['total' => $this->decimalValue($data->total), 'year'=> $data->year];
    return $result;
  }

  public function dimensionQualityAndIndicatorResponse($data) {
    return $data;
  }

  public function dimensionProvinceResponse($data, $dataTarget) {
    $data = $data->toArray();
    $dataTarget = $dataTarget->toArray();
    $result = [];
    foreach ($data as $key => $value) {
      $result[] = array(
        'province_id'=>$value['province']['id'],
        'province_name'=>$value['province']['province_name'],
        'dimension_name'=>$value['dimension']['dimension_name'],
        'dimension_icon'=>$value['dimension']['dimension_icon'],
        'dimension_value'=>$this->decimalValue($value['dimension_value']),
        'dimension_target'=>0,
        'rank'=>$value['rank'] != null ? $value['rank']['sort'] .'/34' : '0/34',
        'year'=>$value['year'],
      );
      foreach ($dataTarget as $keyTarget => $valueTarget) {
        if ($value['province']['id'] == $valueTarget['province_id'] 
          && $value['dimension_id'] == $valueTarget['dimension_id']) 
          $result[$key]['dimension_target'] = $this->decimalValue($valueTarget['dimension_target_value']);
      }
    }
    return $result;
  }

  public function dimensionProvinceTargetResponse($data) {
    $data = $data->toArray();
    $result = [];
    foreach ($data as $key => $value) {
      $result[] = array(
        'province_id'=>$value['province']['id'],
        'province_name'=>$value['province']['province_name'],
        'dimension_name'=>$value['dimension']['dimension_name'],
        'dimension_value'=>$this->decimalValue($value['dimension_target_value']),
        'year'=>$value['year'],
      );
    }
    return $result;
  }

  public function indicatorValueToChartResponse($data)
  {
    $data = $data->toArray();
    $result = [];
    foreach ($data as $keyIndicator => $value) {
      $result[] = array(
        'indicator_code' => $value['indicator_code'],
        'indicator_description' => $value['indicator_description'],
        'min' => $value['min'],
        'max' => $value['max'],
        'indicator_value' => 0,
        'indicator_target_value' => 0,
      );
      foreach ($value['indicator_values'] as $indicatorValue ) {
        $result[$keyIndicator]['indicator_value'] = $this->decimalValue($indicatorValue['indicator_value']);
      }
      foreach ($value['indicator_target_values'] as $indicatorTargetValue ) {
        $result[$keyIndicator]['indicator_target_value'] = $this->decimalValue($indicatorTargetValue['indicator_target_value']);
      }
    }
    return $result;
  }

  public function decimalValue($value) {
    return number_format((float)$value, 2, '.', '');
  }
}
