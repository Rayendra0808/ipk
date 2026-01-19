<?php

use Illuminate\Database\Seeder;

class DOBPapuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data referensi Provinsi untuk wilayah administrasi DOB Papua
        DB::table('provinces')->insert([
            [
                'id' => 92,
                'province_name' => 'PAPUA BARAT DAYA',
            ],
            [
                'id' => 95,
                'province_name' => 'PAPUA SELATAN',
            ],
            [
                'id' => 96,
                'province_name' => 'PAPUA TENGAH',
            ],
            [
                'id' => 97,
                'province_name' => 'PAPUA PEGUNUNGAN',
            ],
        ]);
    }
}
