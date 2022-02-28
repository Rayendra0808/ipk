<?php

namespace App\Http\Controllers;
use App\Dimension;
use App\Province;

class PageController extends Controller
{
  public function index()
  {
    $dimensi = Dimension::getAll();
    $province = Province::getAll();

    return view('home', compact('dimensi', 'province'));
  }

  public function dimensi($slug)
  {
    $dimensi = Dimension::getAll();
    $data = Dimension::getDimensi($slug);
    return view('dimensi.index', compact('data', 'dimensi'));
  }
}
