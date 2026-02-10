<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\DimensionValue;
use App\Models\IndicatorValue;

class DataController extends Controller
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
     * path="/api/data/dimensi-nasional",
     * operationId="getDimensiNasional",
     * tags={"3. Data"},
     * summary="Data dimensi nasional",
     * description="1. Mengembalikan semua data dimensi nasional",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * ),
     * )
     */
    public function dimensiNasional()
    {
        $data = collect($this->tahun)->transform(function ($tahun) {
            return [
                $tahun => DimensionValue::with(['dimension'])
                    ->where('year', $tahun)
                    ->where('province_id', '1001')
                    ->get()
                    ->transform(function ($item) {
                        return [$item->dimension->dimension_code => $item->dimension_value];
                    })
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data dimensi nasional',
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/data/dimensi-provinsi",
     * operationId="getDimensiProvinsi",
     * tags={"3. Data"},
     * summary="Data dimensi provinsi",
     * description="1. Mengembalikan semua data dimensi provinsi",
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
                $tahun => DimensionValue::with(['dimension'])
                ->where('year', $tahun)
                ->where('province_id', $request->kode)
                ->get()
                ->transform(function ($item) {
                    return [$item->dimension->dimension_code => $item->dimension_value];
                })
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data dimensi provinsi ' . $provinsi->name,
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/data/indikator-nasional",
     * operationId="getIndikatorNasional",
     * tags={"3. Data"},
     * summary="Data indikator nasional",
     * description="1. Mengembalikan semua data indikator nasional",
     * @OA\Response(
     * response=200,
     * description="Successful operation",
     * ),
     * )
     */
    public function indikatorNasional()
    {
        $tahunIndikator = config('app.indicator');
        $data = collect($this->tahun)->transform(function ($tahun) use ($tahunIndikator) {
            return [
                $tahun => IndicatorValue::with(['indicator'])
                    ->where('year', $tahun)
                    ->where('province_id', '1001')
                    ->whereIn('indicator_id', $tahunIndikator[$tahun == 2024 ? $tahun : 2023])
                    ->get()
                    ->transform(function ($item) {
                        return [$item->indicator->indicator_code => $item->indicator_value];
                    })
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data indikator nasional',
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/data/indikator-provinsi",
     * operationId="getIndikatorProvinsi",
     * tags={"3. Data"},
     * summary="Data indikator provinsi",
     * description="1. Mengembalikan semua data indikator provinsi",
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
                $tahun => IndicatorValue::with(['indicator'])
                    ->where('year', $tahun)
                    ->where('province_id', $request->kode)
                    ->whereIn('indicator_id', $tahunIndikator[$tahun == 2024 ? $tahun : 2023])
                    ->get()
                    ->transform(function ($item) {
                        return [$item->indicator->indicator_code => $item->indicator_value];
                    })
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data indikator provinsi ' . $provinsi->name,
            'data' => $data
        ]);
    }
}