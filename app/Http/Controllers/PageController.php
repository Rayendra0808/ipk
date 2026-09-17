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
    $homeSlider = [];
    //array_push($homeSlider, ['src' => 'https://www.youtube-nocookie.com/embed/ctTYfgDvngg', 'type' => 'youtube', 'isActive' => true]);
    for ($i = 1; $i <= 2; $i++) {
      array_push($homeSlider, [
        //mencoba merubah slider
        //'src' => asset('assets/img/home-slider/infografis-2023-' . $i . '.webp'),
        //'dataLoad' => asset('assets/img/home-slider/infografis-2023-' . $i . '.webp'),
        'src' => asset('assets/img/home-slider/Infografis-2024-' . $i . '.png'),
        'dataLoad' => asset('assets/img/home-slider/Infografis-2024-' . $i . '.png'),
        'alt' => 'Infografis IPK ' . $i,
        'type' => 'image',
        'isActive' => $i == 1,
      ]);
    }
    return view('home', compact('dimensi', 'province', 'year', 'titlePage', 'homeSlider'));
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
