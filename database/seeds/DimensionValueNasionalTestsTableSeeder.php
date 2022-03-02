<?php

use Illuminate\Database\Seeder;

class DimensionValueNasionalTestTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('dimension_values')->insert(
      [
        ['dimension_id' => '1', 'province_id' => '1001', 'dimension_value' => '29.96', 'year' => '2020'],
        ['dimension_id' => '2', 'province_id' => '1001', 'dimension_value' => '71.26', 'year' => '2020'],
        ['dimension_id' => '3', 'province_id' => '1001', 'dimension_value' => '74.01', 'year' => '2020'],
        ['dimension_id' => '4', 'province_id' => '1001', 'dimension_value' => '41', 'year' => '2020'],
        ['dimension_id' => '5', 'province_id' => '1001', 'dimension_value' => '35.82', 'year' => '2020'],
        ['dimension_id' => '6', 'province_id' => '1001', 'dimension_value' => '61.63', 'year' => '2020'],
        ['dimension_id' => '7', 'province_id' => '1001', 'dimension_value' => '68.01', 'year' => '2020'],
      ]
    );
  }
}
