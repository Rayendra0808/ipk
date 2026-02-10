<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\DimensionValue;
use App\Models\IndicatorValue;

class DokumenController extends Controller
{
    private $tahun = [
        '2018-2020',
        '2021',
        '2022',
        '2023',
        '2024'
    ];

    /**
     * @OA\Get(
     * path="/api/dokumen/buku",
     * operationId="getDokumenBuku",
     * tags={"4. Dokumen"},
     * summary="Dokumen Buku",
     * description="1. Mengembalikan semua dokumen buku",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * ),
     * )
     */
    public function buku()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen Buku',
            'data' => [
                [
                    "judul" => "Handbook IPK 2018",
                    "link" => asset('assets/img/handbook_ipk.pdf')
                ],
                [ 
                    "judul" => "E-book IPK 2020",
                    "link" => asset('assets/pdf/E-book IPK 2020.pdf')
                ],
                [ 
                    "judul" => "E-book IPK 2021",
                    "link" => asset('assets/pdf/E-book IPK 2021.pdf')
                ],
                [ 
                    "judul" => "IPK 2022 dan Analisis Komparatif IPK",
                    "link" => asset('assets/pdf/IPK 2022 dan Analisis Komparatif IPK.pdf')
                ],
                [ 
                    "judul" => "E-book IPK 2023",
                    "link" => asset('assets/pdf/Buku IPK 2023.pdf')
                ],
            ]
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/dokumen/regulasi",
     * operationId="getDokumenRegulasi",
     * tags={"4. Dokumen"},
     * summary="Dokumen Regulasi",
     * description="2. Mengembalikan semua dokumen regulasi",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * ),
     * )
     */
    public function regulasi()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen Regulasi',
            'data' => [
                [
                    "judul" => 'Permendikbudristek No. 55 2022',
                    "link" => asset('assets/pdf/regulations/00. Permendikbudristek Nomor 55 Tahun 2022 CAP.pdf')
                ],
                [
                    "judul" => 'Kepmendikbudristek No. 512 2022 (Hasil 2021)',
                    "link" => asset('assets/pdf/regulations/01. Kepmendikbudristek Nomor 512_M_2022 CAP (Hasil2021).pdf')
                ],
                [
                    "judul" => 'Kepmendikbudristek No. 297 2023 (Hasil 2022)',
                    "link" => asset('assets/pdf/regulations/02. Kepmendikbudristek Nomor 297_M_2023 CAP (hasil2022).pdf')
                ],
                [
                    "judul" => 'Kepmendikbudristek No. 248 2024 (Hasil 2023)',
                    "link" => asset('assets/pdf/regulations/03. Kepmendikbudristek Nomor 248_M_2024 CAP (Hasil2023).pdf')
                ],
                [
                    "judul" => 'Kepmenbud No. 215 2025 (Hasil 2024)',
                    "link" => asset('assets/pdf/regulations/04. Kepmen IPK Tahun 2024 (hasil2024).pdf')
                ],
            ]
        ]); 
    }

    /**
     * @OA\Get(
     * path="/api/dokumen/hasil-perhitungan-nasional",
     * operationId="getDokumenHasilPerhitunganNasional",
     * tags={"4. Dokumen"},
     * summary="Dokumen Hasil Perhitungan Nasional",
     * description="3. Mengembalikan semua dokumen hasil perhitungan nasional",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * ),
     * )
     */
    public function hasilPerhitunganNasional()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen Hasil Perhitungan Nasional',
            'data' => [
                [
                    "judul" => 'Hasil Perhitungan Nasional 2018 - 2022',
                    "link_pdf" => asset('assets/pdf/00 - Nasional 2018-2022.pdf'),
                    "link_excel" => asset('assets/excel/00 - Nasional 2018-2022.xlsx')
                ],
                [
                    "judul" => 'Hasil Perhitungan Nasional 2023',
                    "link_pdf" => asset('assets/pdf/1001. Indonesia - 2023.pdf'),
                    "link_excel" => asset('assets/excel/00 - Nasional 2023.xlsx')
                ]
            ]
        ]); 
    }

    /**
     * @OA\Get(
     * path="/api/dokumen/hasil-perhitungan-provinsi",
     * operationId="getDokumenHasilPerhitunganProvinsi",
     * tags={"4. Dokumen"},
     * summary="Dokumen Hasil Perhitungan Provinsi",
     * description="4. Mengembalikan semua dokumen hasil perhitungan provinsi",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * ),
     * )
     */
    public function hasilPerhitunganProvinsi()
    {
        $provinsi = Province::where('id', '!=', 1001)->get();
        $data = [];

        foreach ($provinsi as $prov) {
            $dokumen = [];
            foreach ($this->tahun as $tahun) {
                if(in_array($prov->id, config('app.dob'))){
                    if($tahun == 2024){
                        $dokumen[] = [
                            "tahun" => $tahun,
                            "judul" => 'Hasil Perhitungan Provinsi ' . $prov->province_name . ' Tahun ' . $tahun,
                            "link_pdf" => asset('assets/provinsi-file/pdf/' . $prov->id . ' - ' . $prov->province_name . ' ' . $tahun . '.pdf'),
                            "link_excel" => asset('assets/provinsi-file/excel/' . $prov->id . ' - ' . $prov->province_name . ' ' . $tahun . '.xlsx')
                        ];
                    }
                }else{
                    $dokumen[] = [
                        "tahun" => $tahun,
                        "judul" => 'Hasil Perhitungan Provinsi ' . $prov->province_name . ' Tahun ' . $tahun,
                        "link_pdf" => asset('assets/provinsi-file/pdf/' . $prov->id . ' - ' . $prov->province_name . ' ' . $tahun . '.pdf'),
                        "link_excel" => asset('assets/provinsi-file/excel/' . $prov->id . ' - ' . $prov->province_name . ' ' . $tahun . '.xlsx')
                    ];
                }
            }
            $data[] = [
                "kode" => $prov->id,
                "nama" => $prov->province_name,
                "dokumen" => $dokumen
            ];
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen Hasil Perhitungan Provinsi',
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/dokumen/metadata-indikator",
     * operationId="getDokumenMetadataIndikator",
     * tags={"4. Dokumen"},
     * summary="Dokumen Metadata Indikator",
     * description="5. Mengembalikan semua dokumen metadata indikator",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * ),
     * )
     */
    public function metadataIndikator()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen Metadata Indikator',
            'data' => [
                [
                    "judul" => 'Metadata Indikator Tahun 2024',
                    "link" => asset('assets/pdf/metadata-indikator-IPK-2024.pdf'),
                ],
            ]
        ]); 
    }
}