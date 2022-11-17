<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProvinceFile extends Model
{
    protected $table = 'province_files';
    protected $primaryKey = 'id';

    public static function getAll()
    {
        $data =  ProvinceFile::where('province_id', '!=', '1001')->get();
        return $data;
    }

    public static function getProvinceFile($id)
    {
        $data =  ProvinceFile::where('id', $id)->first();
        return $data;
    }

    public function getFile()
    {
        $filepath = 'assets/provinsi-file/' . $this->filename;
        return file_exists(public_path($filepath)) ? asset($filepath) : null;
    }
}
