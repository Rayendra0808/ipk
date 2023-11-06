<?php

use App\Models\Dimension;
use Illuminate\Database\Seeder;
use App\Models\Indicator;

class IndicatorsTable2Seeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    // DB::table('indicators')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $csvFile = fopen(base_path("database/data/indicator2.csv"), "r");

    $firstline = true;
    while (($data = fgetcsv($csvFile, 200, ",")) !== FALSE) {
      // @dump($data);
      if (!$firstline) {
        $dimension = Dimension::where('dimension_code', $data[0])->first();
        $indicator = Indicator::where('dimension_id', $dimension->id)->where('indicator_code', $data[2])->first();
        $indicator->indicator_description = $data[3];
        $indicator->indicator_source = $data[4];
        $indicator->save();
      }
      $firstline = false;
    }

    fclose($csvFile);
  }
}
