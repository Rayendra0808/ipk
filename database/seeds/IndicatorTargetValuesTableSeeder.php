<?php

use App\Models\IndicatorTargetValue;
use Illuminate\Database\Seeder;

class IndicatorTargetValuesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('indicator_target_values')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $csvFile = fopen(base_path("database/data/indicator_target_values.csv"), "r");

    $firstline = true;
    while (($data = fgetcsv($csvFile, 200, ",")) !== FALSE) {
      if (!$firstline) {
        IndicatorTargetValue::create([
          "indicator_id" => $data[0],
          "province_id" => ($data[1] != 1001) ? substr($data[1], 0, 2) : $data[1],
          "indicator_target_value" => $data[2],
          "year" => $data[3],
        ]);
      }
      $firstline = false;
    }

    fclose($csvFile);
  }
}
