<?php

use Illuminate\Database\Seeder;
use App\Models\DimensionTotalValueProvince;
use App\Models\DimensionValue;


class Dimensi2024Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Memanggil data dari berkas CSV
        $csvFile = fopen(base_path("database/data/2024_dimensi.csv"), "r");

        while (($data = fgetcsv($csvFile, 200, ",")) !== false) {
            // Mengisi table dimension_total_value_provinces dari kolom ke-8
            DimensionTotalValueProvince::create([
                "province_id" => $data[0],
                "total" => floatval($data[8]),
                "year" => 2024,
            ]);

            // Mengisi table dimension_values dari kolom ke 2-8
            for ($i = 1; $i <= 7; $i++) {
                DimensionValue::create([
                    "province_id" => $data[0], // kolom ke-1
                    "dimension_id" => $i,
                    "dimension_value" => floatval($data[$i]),
                    "year" => 2024,
                ]);
            }
        }
        fclose($csvFile);

    }
}
