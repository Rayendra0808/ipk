<?php

use Illuminate\Database\Seeder;
use App\Models\DimensionQuality;

class DimensionQualitiesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('dimension_qualities')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    DimensionQuality::truncate();
    DB::table('dimension_qualities')->insert(
      [
        ['year' => '2019', 'quality' => '0.10', 'dimension_id' => '1', 'formula' => 'rumus-dimensi-ekonomi-budaya.jpeg'],
        ['year' => '2019', 'quality' => '0.20', 'dimension_id' => '2', 'formula' => 'rumus-dimensi-pendidikan.jpeg'],
        ['year' => '2019', 'quality' => '0.20', 'dimension_id' => '3', 'formula' => 'rumus-dimensi-ketahanan-nasional.jpeg'],
        ['year' => '2019', 'quality' => '0.25', 'dimension_id' => '4', 'formula' => 'rumus-dimensi-warisan-budaya.jpeg'],
        ['year' => '2019', 'quality' => '0.10', 'dimension_id' => '5', 'formula' => 'rumus-dimensi-ekspresi-budaya.jpeg'],
        ['year' => '2019', 'quality' => '0.10', 'dimension_id' => '6', 'formula' => 'rumus-dimensi-budaya-literasi.jpeg'],
        ['year' => '2019', 'quality' => '0.05', 'dimension_id' => '7', 'formula' => 'rumus-dimensi-gender.jpeg'],
      ]
    );
  }
}
