<?php

use Illuminate\Database\Seeder;
use App\Models\Dimension;

class DimensionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('dimensions')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    DB::table('dimensions')->insert(
      [
        ['dimension_name' => 'Ekonomi Budaya', 'dimension_slug' => 'ekonomi-budaya', 'dimension_code' => 'D1', 'dimension_icon' => 'ekonomibudaya.png', 'dimension_description' => 'Aktivitas ekonomi yang tercipta sebagai hasil dari pemanfaatan Objek Pemajuan Kebudayaan'],
        ['dimension_name' => 'Pendidikan', 'dimension_slug' => 'pendidikan', 'dimension_code' => 'D2', 'dimension_icon' => 'pendidikan.png', 'dimension_description' => 'Usaha sadar dan terencana untuk mewujudkan suasana belajar dan proses pembelajaran yang inklusif agar peserta didik secara aktif mengembangkan potensi dirinya dalam bidang Seni, Budaya, dan Bahasa'],
        ['dimension_name' => 'Ketahanan Sosial Budaya', 'dimension_slug' => 'ketahanan-sosial-budaya', 'dimension_code' => 'D3', 'dimension_icon' => 'ketahanannasional.png', 'dimension_description' => 'Ketahanan Sosial Budaya Ketahanan Sosial Budaya dalam konteks penyusunan IPK didefinisikan sebagai kemampuan suatu kebudayaan dalam mempertahankan dan mengembangkan identitas, pengetahuan, serta praktik budayanya yang relevan yang didukung oleh kondisi sosial dalam masyarakat.  Dimensi ini terdiri atas 8 indikator Indikator 3.1 (X3.1) : Persentase masyarakat yang setuju jika ada sekelompok orang dari agama lain yang melakukan kegiatan di lingkungan sekitar tempat tinggal Sumber Data : Survei Sosial Ekonomi Nasional Modul Sosial, Budaya, dan Pendidikan (SUSENAS MSBP), Badan Pusat Statistik Indikator 3.2 (X3.2) : Persentase masyarakat yang setuju jika ada sekelompok orang dari suku lain yang melakukan kegiatan di lingkungan sekitar tempat tinggal Sumber Data : Survei Sosial Ekonomi Nasional Modul Sosial, Budaya, dan Pendidikan (SUSENAS MSBP), Badan Pusat Statistik Indikator 3.3 (X3.3) : Persentase masyarakat yang setuju jika salah satu anggota rumah tangga Anda bersahabat dengan orang lain yang beda agama Sumber Data : Survei Sosial Ekonomi Nasional Modul Sosial, Budaya, dan Pendidikan (SUSENAS MSBP), Badan Pusat Statistik Indikator 3.4 (X3.4) : Persentase masyarakat yang setuju jika salah satu anggota rumah tangga Anda bersahabat dengan orang lain yang berbeda suku Sumber Data : Survei Sosial Ekonomi Nasional Modul Sosial, Budaya, dan Pendidikan (SUSENAS MSBP), Badan Pusat Statistik Indikator 3.5 (X3.5) : Persentase penduduk berumur 10 tahun ke atas yang mengikuti kegiatan sosial kemasyarakatan di lingkungan sekitar dalam tiga bulan terakhir Sumber Data : Survei Sosial Ekonomi Nasional Modul Sosial, Budaya, dan Pendidikan (SUSENAS MSBP), Badan Pusat Statistik Indikator 3.6 (X3.6) : Persentase penduduk usia 10 tahun ke atas yang mengikuti gotong royong Sumber Data : Survei Sosial Ekonomi Nasional Modul Sosial, Budaya, dan Pendidikan (SUSENAS MSBP), Badan Pusat Statistik Indikator 3.7 (X3.7) : Persentase rumah tangga yang tidak merasa khawatir dengan keamanan saat berjalan kaki sendirian di malam hari dalam setahun terakhir Sumber Data : Survei Sosial Ekonomi Nasional Modul Ketahanan Sosial (SUSENAS Hansos), Badan Pusat Statistik Indikator 3.8 (X3.8) : Persentase masyarakat yang merasa aman di lingkungan tempat tinggal Sumber Data : Survei Sosial Ekonomi Nasional Modul Ketahanan Sosial (SUSENAS Hansos), Badan Pusat Statistik'],
        ['dimension_name' => 'Warisan Budaya', 'dimension_slug' => 'warisan-budaya', 'dimension_code' => 'D4', 'dimension_icon' => 'warisanbudaya.png', 'dimension_description' => 'Upaya yang dilakukan seluruh pihak (masyarakat dan pemerintah) terhadap pelestarian Objek Pemajuan Kebudayaan dan Cagar Budaya'],
        ['dimension_name' => 'Ekspresi Budaya', 'dimension_slug' => 'ekspresi-budaya', 'dimension_code' => 'D5', 'dimension_icon' => 'kebebasanbudaya.png', 'dimension_description' => 'Segala aktivitas yang dilakukan untuk mendukung proses penciptaan karya budaya yang dihasilkan masyarakat'],
        ['dimension_name' => 'Budaya Literasi', 'dimension_slug' => 'budaya-literasi', 'dimension_code' => 'D6', 'dimension_icon' => 'literasibudaya.png', 'dimension_description' => 'Aktivitas serta sarana/prasarana pendukung dalam memperoleh, menguji kesahihan, dan menghasilkan informasi dan pengetahuan untuk pemberdayaan kecakapan masyarakat'],
        ['dimension_name' => 'Gender', 'dimension_slug' => 'gender', 'dimension_code' => 'D7', 'dimension_icon' => 'gender.png', 'dimension_description' => 'Persamaan hak, tanggung jawab dan peluang yang setara antara perempuan dan laki-laki di ruang publik untuk berpartisipasi dalam kegiatan pembangunan'],
      ]
    );
  }
}
