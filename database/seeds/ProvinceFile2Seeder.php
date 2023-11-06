<?php

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceFile2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = Province::getAll();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('province_files')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        foreach (array_filter(iterator_to_array($provinces), function ($province) {
            return !in_array($province->id, ['18', '31', '35', '36', '62', '64', '73', '81']);
        }) as $province) {
            DB::table('province_files')->insert([
                'province_id' => $province->id,
                'filename' => $province->id . '. ' . strtoupper($province->province_name) . ' 2022.pdf',
                'title' => 'Data Hasil Penghitungan IPK Provinsi ' . $province->province_name . ' 2022',
            ],);
        }
    }
}
