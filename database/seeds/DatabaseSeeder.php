<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProvincesTableSeeder::class);
        $this->call(DimensionsTableSeeder::class);
        $this->call(DimensionQualitiesTableSeeder::class);
        $this->call(IndicatorsTableSeeder::class);
        $this->call(DimensionValuesTableSeeder::class);
        $this->call(DimensionTotalValueProvincesTableSeeder::class);
        $this->call(DimensionTotalTargetProvincesTableSeeder::class);
        $this->call(DimensionTargetValuesTableSeeder::class);
        $this->call(IndicatorValuesTableSeeder::class);
        $this->call(IndicatorTargetValuesTableSeeder::class);
        $this->call(ProvinceFileSeeder::class);
        $this->call(ProvinceDimensionTextSeeder::class);
        // new seeder
        $this->call(ProvinceFile2Seeder::class);
        $this->call(IndicatorsTable2Seeder::class);
        $this->call(DimensionValuesTable2Seeder::class);
    }
}
