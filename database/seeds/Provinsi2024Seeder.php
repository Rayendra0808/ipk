<?php


use App\Models\Province;
use Illuminate\Database\Seeder;

class Provinsi2024Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Memanggil data referensi provinsi
        $provinces = Province::getAll();

        foreach ($provinces as $province) {
            
            // Mengisi tabel province_files dengan data berkas tiap provinsi
            DB::table('province_files')->insert([
                'province_id' => $province->id,
                'filename' => 'Perhitungan_Provinsi_' . $province->province_name . '_2024.pdf',
                'title' => 'Data Hasil Penghitungan IPK Provinsi ' . $province->province_name . ' 2024',
            ]);

        }

    }
}
