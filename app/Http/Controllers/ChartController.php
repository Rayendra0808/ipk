<?php

namespace App\Http\Controllers;

use App\Models\Dimension;
use App\Models\DimensionValue;
use App\Models\DimensionTotalValueProvince;
use App\Models\DimensionTargetValue;
use App\Traits\TransformTrait;
use App\Models\Indicator;
use App\Models\Province;
use Illuminate\Http\Request;

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

  public function getTotalValueProvince($year)
  {
    $data = DimensionTotalValueProvince::select(['province_id', 'total'])->where('year', $year)->get();
    $nasional = null;
    foreach ($data as $item) {
      if ($item->province_id == '1001') $nasional = $item;
    }
    $data = array_filter(iterator_to_array($data), function ($item) {
      return $item->province_id != '1001';
    });
    $provinsi = [];
    foreach ($data as $item) {
      $provinsi[$item->province_id] = $item->total;
    }
    return response()->json([
      "tahun" => (int) $year,
      "nasional" => $nasional ? $nasional->total : 0,
      "provinsi" => $provinsi
    ], 200);
  }

  public function getDimensionProvince(Request $request)
  {
    $data = DimensionValue::getDimensionProvince($request);
    $dataTarget = DimensionTargetValue::getDimensionProvinceTarget($request);
    $result = $this->dimensionProvinceResponse($data, $dataTarget);
    return response()->json($result, 200);
  }

  public function getDimensionProvinceTarget(Request $request)
  {
    $data = DimensionTargetValue::getDimensionProvinceTarget($request);
    $result = $this->dimensionProvinceTargetResponse($data);
    return response()->json($result, 200);
  }

  public function getIndicatorProvince(Request $request)
  {
    $data = Indicator::getIndicatorValues($request);
    $result = $this->indicatorValueToChartResponse($data);
    return response()->json($result, 200);
  }

  public function getProvince()
  {
    $data = Province::getAll()->pluck('province_name', 'id');
    return response()->json($data, 200);
  }
}
