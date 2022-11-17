<?php

use App\Models\DimensionValue;
use Illuminate\Database\Seeder;

class ProvinceDimensionTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csvFile = fopen(base_path("database/data/ipk-resume.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 100000, ",")) !== FALSE) {
            if (!$firstline) {
                $dimensionValue = DimensionValue::where('dimension_id', $data[2])
                    ->where('province_id', ($data[1] != 1001) ? substr($data[1], 0, 2) : $data[1])
                    ->where('year', $data[4])
                    ->first();
                if ($dimensionValue) {
                    $dimensionValue->desc = isset($data[3]) && $data[3] != '' ? $data[3] : null;
                    $dimensionValue->save();
                }
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
