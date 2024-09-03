<?php

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceFileTambahan2022Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Kode Prov : 18 : LAMPUNG
        // 2. Kode Prov : 31 : DKI JAKARTA
        // 3. Kode Prov : 35 : JAWA TIMUR
        // 4. Kode Prov : 36 : BANTEN
        // 5. Kode Prov : 62 : KALIMANTAN TENGAH
        // 6. Kode Prov : 64 : KALIMANTAN TIMUR
        // 7. Kode Prov : 73 : SULAWESI SELATAN
        // 8. Kode Prov : 81 : MALUKU
        $provinces = [
            (object) [
                'id' => 18,
                'province_name' => 'LAMPUNG',
            ],
            (object) [
                'id' => 31,
                'province_name' => 'DKI JAKARTA',
            ],
            (object) [
                'id' => 35,
                'province_name' => 'JAWA TIMUR',
            ],
            (object) [
                'id' => 36,
                'province_name' => 'BANTEN',
            ],
            (object) [
                'id' => 62,
                'province_name' => 'KALIMANTAN TENGAH',
            ],
            (object) [
                'id' => 64,
                'province_name' => 'KALIMANTAN TIMUR',
            ],
            (object) [
                'id' => 73,
                'province_name' => 'SULAWESI SELATAN',
            ],
            (object) [
                'id' => 81,
                'province_name' => 'MALUKU',
            ]
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('province_files')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($provinces as $province) {
            DB::table('province_files')->insert([
                'province_id' => $province->id,
                'filename' => $province->id . '. ' . $province->province_name . ' 2022.pdf',
                'title' => 'Data Hasil Penghitungan IPK Provinsi ' . $province->province_name . ' 2022',
            ], );
        }
    }
}
