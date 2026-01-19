<?php

use Illuminate\Database\Seeder;
use App\Models\Indicator;

class IndicatorsReference2024Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/indikator_referensi_2024.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 200, ",")) !== FALSE) {
        // @dump($data);
        if (!$firstline) {
            Indicator::create([
            "dimension_id" => $data[0],
            "indicator_code" => $data[1],
            "indicator_description" => $data[2],
            "indicator_source" => $data[3],
            "min" => $data[4],
            "max" => $data[5],
            ]);
        }
        $firstline = false;
        }

        fclose($csvFile);
    }
}
