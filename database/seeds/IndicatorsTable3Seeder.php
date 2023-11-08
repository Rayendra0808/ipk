<?php

use App\Models\Dimension;
use Illuminate\Database\Seeder;
use App\Models\Indicator;

class IndicatorsTable3Seeder extends Seeder
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

    $indicator = Indicator::where('indicator_code', 'X4.4')->first();
    $indicator->indicator_description = 'Persentase penduduk usia 10 tahun ke atas yang menonton secara langsung pertunjukkan seni dalam 3 bulan terakhir.<br>*tahun 2021 ada perluasan definisi operasional (termasuk yang tidak langsung) dari nilai maksimum 70 untuk tahun 2018-2020 menjadi nilai maksimum 100 untuk tahun 2021-2022';
    $indicator->max = 100;
    $indicator->save();
  }
}
