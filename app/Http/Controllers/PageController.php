<?php

namespace App\Http\Controllers;
use App\Models\Dimension;
use App\Models\Province;
use App\Traits\TransformTrait;
class PageController extends Controller
{
  use TransformTrait;
  public function index()
  {
    $dimensi = Dimension::getAll();
    $year = Dimension::getYear();
    $province = Province::getAll();

    return view('home', compact('dimensi', 'province', 'year'));
  }

  public function dimensi($slug)
  {
    $dimensi = Dimension::getAll();
    $year = Dimension::getYear();
    $dataIndicator = Dimension::getDimensionWithIndicator($slug);
    $data = $this->dimensionQualityAndIndicatorResponse($dataIndicator);
    return view('dimension.index', compact('data', 'dimensi', 'year'));
  }

  public function nasional()
  {
    $dimensi = Dimension::getAll();
    $year = Dimension::getYear();
    // $dataIndicator = Dimension::getDimensionWithIndicator($slug);
    // $data = $this->dimensionQualityAndIndicatorResponse($dataIndicator);
    return view('nasional.index', compact('dimensi', 'year'));
  }

  public function provinsi($provinceId)
  {
    $dimensi = Dimension::getAll();
    $year = Dimension::getYear();
    $provinsi = Province::find($provinceId);
    $provinsiData = Province::getAll();
 
    return view('provinsi.index', compact('dimensi', 'year', 'provinsi', 'provinsiData'));
  }
}
