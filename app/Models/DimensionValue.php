<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimensionValue extends Model
{
    protected $table = 'dimension_values';
    protected $primaryKey = 'id';

    public static function getAll()
    {
        $data =  DimensionValue::get();
        return $data;
    }

    public static function getAreaNasionalByYear($year)
    {
        $data =  DimensionValue::select('dimensions.dimension_name', 'dimensions.dimension_icon', 'dimension_values.*')
            ->join('dimensions', 'dimension_values.dimension_id', '=', 'dimensions.id')
            ->where('dimension_values.year', $year)
            ->where('dimension_values.province_id', '1001')
            ->get();
        return $data;
    }
}
