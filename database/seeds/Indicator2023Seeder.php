<?php

use Illuminate\Database\Seeder;
use App\Models\IndicatorValue;

class Indicator2023Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('province_files')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Get Data from CSV
        $csvFile = fopen(base_path("database/data/2023_indicator.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 200, "	")) !== false) {
            for ($i = 1; $i <= 31; $i++) {
                IndicatorValue::create([
                    "province_id" => $data[0],
                    "indicator_id" => $i,
                    "indicator_value" => floatval($data[$i]),
                    "year" => 2023,
                ]);
            }
        }

        fclose($csvFile);

    }
}
