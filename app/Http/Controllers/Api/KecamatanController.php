<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KecamatanController extends Controller
{
    public function getKecamatanByKota($city_id)
    {
        try {
            $cities = Subdistrict::where('city_id', $city_id)->get();
            return response()->json(['data' => $cities, 'message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
