<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Dimension;
use App\Models\Indicator;

class ReferensiController extends Controller
{
    private $tahun = [
        2018,
        2019,
        2020,
        2021,
        2022,
        2023,
        2024
    ];

    /**
     * @OA\Get(
     * path="/api/referensi/tahun",
     * operationId="getReferensiTahunList",
     * tags={"1. Referensi"},
     * summary="Data referensi tahun",
     * description="1. Mengembalikan semua data referensi tahun",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * )
     * )
     */
    public function tahun()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data referensi tahun',
            'data' => $this->tahun
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/referensi/provinsi",
     * operationId="getReferensiProvinsiList",
     * tags={"1. Referensi"},
     * summary="Data referensi provinsi",
     * description="2. Mengembalikan semua data referensi provinsi",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * )
     * )
     */
    public function provinsi()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data referensi provinsi',
            'data' => Province::select(['id as kode', 'province_name as nama'])->where('id', '!=', '1001')->get()
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/referensi/dimensi",
     * operationId="getReferensiDimensiList",
     * tags={"1. Referensi"},
     * summary="Data referensi dimensi",
     * description="3. Mengembalikan semua data referensi dimensi",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * )
     * )
     */
    public function dimensi()
    {
        $data = Dimension::select(['id', 'dimension_code as kode', 'dimension_name as nama', 'dimension_description as deskripsi', 'dimension_icon as icon'])->with(['dimensionQualities'])->orderBy('dimension_code', 'asc')->get();

        $data->transform(function ($item) {
            $item->icon = asset('assets/img/'.$item->icon);
            $item->rumus = collect($this->tahun)->mapWithKeys(function ($tahun) use ($item) {
                if ($tahun == 2024) {
                    return [
                        $tahun => asset('assets/img/2024/'.str_replace('.jpeg', '.png', $item->dimensionQualities->first()->formula))
                    ];
                } else {
                    return [
                        $tahun => asset('assets/img/'.$item->dimensionQualities->first()->formula)
                    ];
                }
            });
            $item->min = 0;
            $item->max = 100;
            unset($item->dimensionQualities); // Remove dimensionQualities from output after loading relation
            return $item;
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data referensi dimensi',
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/referensi/indikator",
     * operationId="getReferensiIndikatorList",
     * tags={"1. Referensi"},
     * summary="Data referensi indikator",
     * description="4. Mengembalikan semua data referensi indikator",
     * @OA\Parameter(
     *    name="tahun",
     *    in="query",
     *    required=true,
     *    description="Tahun data",
     *    @OA\Schema(
     *       type="integer"
     *    )
     * ),
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * ),
     * @OA\Response(
     * response=400,
     * description="Bad Request"
     * )
     * )
     */
    public function indikator(Request $request)
    {
        if (!$request->has('tahun')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Parameter tahun wajib dikirim.'
            ], 400);
        }

        if (!in_array($request->tahun, $this->tahun)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada data untuk tahun '.$request->tahun.'.'
            ], 400);
        }

        $tahun = $request->tahun;
        $tahunIndikator = config('app.indicator');

        $data = Indicator::join('dimensions', 'indicators.dimension_id', '=', 'dimensions.id')
            ->select([
                'dimensions.id as dimensi_id',
                'dimensions.dimension_code as dimensi_kode',
                'dimensions.dimension_name as dimensi_nama',
                'indicators.id',
                'indicators.indicator_code as kode',
                'indicators.indicator_description as indikator',
                'indicators.indicator_source as sumber',
                'indicators.min as nilai_minimum',
                'indicators.max as nilai_maksimum',
            ])
            ->whereIn('indicators.id', $tahunIndikator[$tahun == 2024 ? $tahun : 2023])
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data referensi indikator',
            'data' => $data
        ]);
    }
}