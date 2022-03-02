<?php

namespace App\Http\Controllers;
use App\Models\Dimension;
use App\Models\Province;

class PageController extends Controller
{
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
    $data = Dimension::getDimensi($slug);
    return view('dimension.index', compact('data', 'dimensi'));
  }
}
