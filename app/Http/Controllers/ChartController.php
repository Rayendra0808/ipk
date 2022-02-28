<?php

namespace App\Http\Controllers;
use App\DimensionValue;

class ChartController extends Controller
{
  public function getAreaNasionalByYear($year)
  {
    $dimensi = DimensionValue::getAll();
    $data = DimensionValue::getAreaNasionalByYear($year);
    return response()->json($data, 200);
  }
}
