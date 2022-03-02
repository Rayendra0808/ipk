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
  
      $csvFile = fopen(base_path("database/data/dimension_total_target.csv"), "r");
  
      $firstline = true;
      while (($data = fgetcsv($csvFile, 200, ",")) !== FALSE) {
        if (!$firstline) {
          DimensionTargetValue::create([
            "province_id" => ($data[0] != 1001) ? substr($data[0], 0, 2) : $data[0],
            "dimension_target_value" => $data[1],
            "year" => $data[2],
          ]);
        }
        $firstline = false;
      }
  
      fclose($csvFile);
    }
}
