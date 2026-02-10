<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DimensionTargetValue;
use App\Models\IndicatorTargetValue;
use App\Models\Province;

class ProyeksiController extends Controller
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
     * path="/api/proyeksi/dimensi-nasional",
     * operationId="getProyeksiDimensiNasional",
     * tags={"2. Proyeksi"},
     * summary="Data proyeksi dimensi nasional",
     * description="1. Mengembalikan semua data proyeksi dimensi nasional",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * )
     * )
     */
    public function dimensiNasional()
    {
        $data = collect($this->tahun)->transform(function ($tahun) {
            return [
                $tahun => DimensionTargetValue::with(['dimension'])
                    ->where('year', $tahun)
                    ->where('province_id', '1001')
                    ->get()
                    ->transform(function ($item) {
                        return [$item->dimension->dimension_code => $item->dimension_target_value];
                    })
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data proyeksi dimensi nasional',
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/proyeksi/dimensi-provinsi",
     * operationId="getProyeksiDimensiProvinsi",
     * tags={"2. Proyeksi"},
     * summary="Data proyeksi dimensi provinsi",
     * description="1. Mengembalikan semua data proyeksi dimensi provinsi",
     * @OA\Parameter(
     *    name="kode",
     *    in="query",
     *    required=true,
     *    description="Kode provinsi",
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
    public function dimensiProvinsi(Request $request)
    {
        if (!$request->has('kode')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Parameter kode provinsi wajib dikirim.'
            ], 400);
        }

        $provinsi = Province::where('id', $request->kode)->first();

        if (!$provinsi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Provinsi tidak ditemukan.'
            ], 400);
        }

        $data = collect($this->tahun)->transform(function ($tahun) use ($request) {
            return [
                $tahun => DimensionTargetValue::with(['dimension'])
                    ->where('year', $tahun)
                    ->where('province_id', $request->kode)
                    ->get()
                    ->transform(function ($item) {
                        return [$item->dimension->dimension_code => $item->dimension_target_value];
                    })
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data proyeksi dimensi provinsi ' . $provinsi->name,
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/proyeksi/indikator-nasional",
     * operationId="getProyeksiIndikatorNasional",
     * tags={"2. Proyeksi"},
     * summary="Data proyeksi indikator nasional",
     * description="1. Mengembalikan semua data proyeksi indikator nasional",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * )
     * )
     */
    public function indikatorNasional()
    {
        $tahunIndikator = config('app.indicator');
        $data = collect($this->tahun)->transform(function ($tahun) use ($tahunIndikator) {
            return [
                $tahun => IndicatorTargetValue::with(['indicator'])
                    ->where('year', $tahun)
                    ->where('province_id', '1001')
                    ->whereIn('indicator_id', $tahunIndikator[2023])
                    ->get()
                    ->transform(function ($item) {
                        return [$item->indicator->indicator_code => $item->indicator_target_value];
                    })
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data proyeksi indikator nasional',
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/proyeksi/indikator-provinsi",
     * operationId="getProyeksiIndikatorProvinsi",
     * tags={"2. Proyeksi"},
     * summary="Data proyeksi indikator provinsi",
     * description="1. Mengembalikan semua data proyeksi indikator provinsi",
     * @OA\Parameter(
     *    name="kode",
     *    in="query",
     *    required=true,
     *    description="Kode provinsi",
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
    public function indikatorProvinsi(Request $request)
    {
        if (!$request->has('kode')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Parameter kode provinsi wajib dikirim.'
            ], 400);
        }

        $provinsi = Province::where('id', $request->kode)->first();

        if (!$provinsi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Provinsi tidak ditemukan.'
            ], 400);
        }

        $tahunIndikator = config('app.indicator');
        $data = collect($this->tahun)->transform(function ($tahun) use ($tahunIndikator, $request) {
            return [
                $tahun => IndicatorTargetValue::with(['indicator'])
                    ->where('year', $tahun)
                    ->where('province_id', $request->kode)
                    ->whereIn('indicator_id', $tahunIndikator[2023])
                    ->get()
                    ->transform(function ($item) {
                        return [$item->indicator->indicator_code => $item->indicator_target_value];
                    })
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data proyeksi indikator provinsi ' . $provinsi->name,
            'data' => $data
        ]);
    }
}