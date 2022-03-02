<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
  protected $table = 'indicators';
  protected $primaryKey = 'id';
  
  public static function getAll()
  {
    $data =  Indicator::get();
    return $data;
  }
}
