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
            $files = [
                [
                    'province_id' => $province->id,
                    'filename' => $province->id . '.pdf',
                    'title' => 'Data Hasil Penghitungan IPK Provinsi ' . $province->province_name . ' 2018-2020',
                ],
            ];
            if (in_array($province['id'], ['13', '31', '51', '75'])) {
                array_push($files, [
                    'province_id' => $province->id,
                    'filename' => $province->id . ' - ' . $province->province_name . ' - rev.pdf',
                    'title' => 'Data Hasil Penghitungan IPK Provinsi ' . $province->province_name . ' 2021',
                ]);
            } else {
                array_push($files, [
                    'province_id' => $province->id,
                    'filename' => $province->id . ' - ' . $province->province_name . '.pdf',
                    'title' => 'Data Hasil Penghitungan IPK Provinsi ' . $province->province_name . ' 2021',
                ]);
            }
            DB::table('province_files')->insert($files);
        }
    }
}
