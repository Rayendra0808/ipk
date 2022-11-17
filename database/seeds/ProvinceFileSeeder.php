<?php

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceFileSeeder extends Seeder
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
        DB::table('province_files')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        foreach ($provinces as $province) {
            DB::table('province_files')->insert(
                [
                    [
                        'province_id' => $province->id,
                        'filename' => $province->id . '.pdf',
                        'title' => 'Data Hasil Penghitungan IPK Provinsi ' . $province->province_name . ' 2018-2020',
                    ],
                    [
                        'province_id' => $province->id,
                        'filename' => $province->id . ' - ' . $province->province_name . '.pdf',
                        'title' => 'Data Hasil Penghitungan IPK Provinsi ' . $province->province_name . ' 2021',
                    ],
                ]
            );
        }
    }
}
