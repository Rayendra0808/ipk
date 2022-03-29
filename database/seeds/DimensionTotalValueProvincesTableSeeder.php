<?php

use App\Models\DimensionTotalValueProvince;
use Illuminate\Database\Seeder;

class DimensionTotalValueProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('dimension_total_value_provinces')->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  
      $csvFile = fopen(base_path("database/data/dimension_total_value_provinces.csv"), "r");
  
      $firstline = true;
      while (($data = fgetcsv($csvFile, 200, ",")) !== FALSE) {
        if (!$firstline) {
          DimensionTotalValueProvince::create([
            "province_id" => ($data[0] != 1001) ? substr($data[0], 0, 2) : $data[0],
            "total" => $data[1],
            "year" => $data[2],
          ]);
        }
        $firstline = false;
      }
  
      fclose($csvFile);
    }
}
