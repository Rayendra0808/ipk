<?php

use Illuminate\Database\Seeder;
use App\Models\IndicatorValue;

class Indikator2024Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pilihan indikator tahun 2024
        $indicator = config('app.indicator.2024');

        // Memanggil data dari berkas CSV
        $csvFile = fopen(base_path("database/data/2024_indikator.csv"), "r");

        // Mengisi table indicator_values dari kolom ke 2-31
        while ($data = fgetcsv($csvFile, 200, ",")) {
            for ($i = 1; $i <= 25; $i++) {
                IndicatorValue::create([
                    "province_id" => $data[0],
                    "indicator_id" => $indicator[$i-1],
                    "indicator_value" => floatval($data[$i]),
                    "year" => 2024,
                ]);
            }
        }
        fclose($csvFile);
    }
}
