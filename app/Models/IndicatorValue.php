<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Indicator;

class IndicatorValue extends Model
{
  protected $table = 'indicator_values';
  protected $primaryKey = 'id';

  public function indicator()
  {
    return $this->belongsTo(Indicator::class);
  }
}
