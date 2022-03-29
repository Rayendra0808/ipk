<?php

use App\Models\DimensionTargetValue;
use Illuminate\Database\Seeder;

class DimensionTargetValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('dimension_target_values')->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  
      $csvFile = fopen(base_path("database/data/dimension_target_values.csv"), "r");
  
      $firstline = true;
      while (($data = fgetcsv($csvFile, 200, ",")) !== FALSE) {
        if (!$firstline) {
          DimensionTargetValue::create([
            "province_id" => ($data[1] != 1001) ? substr($data[1], 0, 2) : $data[1],
            "dimension_id" => $data[0],
            "dimension_target_value" => $data[2],
            "year" => $data[3],
          ]);
        }
        $firstline = false;
      }
  
      fclose($csvFile);
    }
}
