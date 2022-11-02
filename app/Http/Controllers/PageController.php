<?php

namespace App\Http\Controllers;

use App\Models\Dimension;
use App\Models\Province;
use App\Models\DimensionTotalValueProvince;
use App\Traits\TransformTrait;
use Illuminate\Http\Request;

class PageController extends Controller
{
  use TransformTrait;
  public function index()
  {
    $dimensi = Dimension::getAll();
    $year = Dimension::getYear();
    $province = Province::getAll();
    $titlePage = 'Indeks Pembangunan Kebudayaan | Beranda';
    return view('home', compact('dimensi', 'province', 'year', 'titlePage'));
  }

  public function dimensi($slug)
  {
    $dimensi = Dimension::getAll();
    $year = Dimension::getYear();
    $dataIndicator = Dimension::getDimensionWithIndicator($slug);
    $data = $this->dimensionQualityAndIndicatorResponse($dataIndicator);
    $titlePage = 'Indeks Pembangunan Kebudayaan | Dimensi ' . $data['dimension_name'];
    return view('dimension.index', compact('data', 'dimensi', 'year', 'titlePage'));
  }

  public function nasional()
  {
    $dimensi = Dimension::getAll();
    $year = Dimension::getYear();
    $titlePage = 'Indeks Pembangunan Kebudayaan | Nasional';
    // $dataIndicator = Dimension::getDimensionWithIndicator($slug);
    // $data = $this->dimensionQualityAndIndicatorResponse($dataIndicator);
    return view('nasional.index', compact('dimensi', 'year', 'titlePage'));
  }

  public function provinsi(Request $request, $provinceId)
  {
    $dimensi = Dimension::getAll();
    $year = Dimension::getYear();
    $provinsi = Province::getProvince($provinceId);
    $provinsiData = Province::getAll();
    $totalData = DimensionTotalValueProvince::getDimensionTotal($provinceId);
    $titlePage = 'Indeks Pembangunan Kebudayaan | Provinsi ' . ucwords(strtolower($provinsi->province_name));

    return view('provinsi.index', compact('dimensi', 'year', 'provinsi', 'provinsiData', 'totalData', 'titlePage'));
  }
}
