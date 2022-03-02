<?php

use Illuminate\Database\Seeder;
use App\Models\Indicator;

class IndicatorsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('indicators')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $csvFile = fopen(base_path("database/data/indicator.csv"), "r");

    $firstline = true;
    while (($data = fgetcsv($csvFile, 200, ",")) !== FALSE) {
      if (!$firstline) {
        Indicator::create([
          "dimension_id" => $data[0],
          "indicator_code" => $data[1],
          "indicator_description" => $data[2],
          "indicator_source" => $data[3],
        ]);
      }
      $firstline = false;
    }

    fclose($csvFile);
  }
}
