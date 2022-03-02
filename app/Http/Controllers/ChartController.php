<?php

namespace App\Http\Controllers;
use App\Models\Dimension;
use App\Models\DimensionTotalValueProvince;
use App\Traits\TransformTrait;
class ChartController extends Controller
{
  use TransformTrait;
  public function getDimension($year, $provinceId)
  {
    $data = Dimension::getDimensionData($year, $provinceId);
    $result = $this->dimensionValueToChartResponse($data);
    return response()->json($result, 200);
  }

  public function getDimensionTotalProvince($year, $provinceId)
  {
    $data = DimensionTotalValueProvince::getTotal($year, $provinceId);
    $result = $this->dimensionTotalValueToChartResponse($data);
    return response()->json($result, 200);
  }
}
