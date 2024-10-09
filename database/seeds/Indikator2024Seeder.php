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
        // Memanggil data dari berkas CSV
        $csvFile = fopen(base_path("database/data/2024_indikator.csv"), "r");

        // Mengisi table indicator_values dari kolom ke 2-31
        while ($data = fgetcsv($csvFile, 200, ",")) {
            for ($i = 1; $i <= 31; $i++) {
                IndicatorValue::create([
                    "province_id" => $data[0],
                    "indicator_id" => $i,
                    "indicator_value" => floatval($data[$i]),
                    "year" => 2024,
                ]);
            }
        }
        fclose($csvFile);
    }
}
