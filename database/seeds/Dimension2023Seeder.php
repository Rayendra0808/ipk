<?php

use Illuminate\Database\Seeder;
use App\Models\DimensionTotalValueProvince;
use App\Models\DimensionValue;

class Dimension2023Seeder extends Seeder
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
        $csvFile = fopen(base_path("database/data/2023_dimension.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 200, "	")) !== false) {
            DimensionTotalValueProvince::create([
                "province_id" => $data[0],
                "total" => floatval($data[8]),
                "year" => 2023,
            ]);

            for ($i=1; $i <= 7; $i++) {
                DimensionValue::create([
                    "province_id" => $data[0],
                    "dimension_id" => $i,
                    "dimension_value" => floatval($data[$i]),
                    "year" => 2023,
                ]);
            }
        }

        fclose($csvFile);

    }
}
