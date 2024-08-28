<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Subdistrict;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeleteAccountMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('account-delete');
    }
    public function requestDelete(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();
        $token = Str::random(60);
        $user->delete_token = hash('sha256', $token);
        $user->delete_token_expires = now()->addMinutes(30);
        $user->save();

        Mail::to($user->email)->send(new DeleteAccountMail($token));
        toast('We have emailed your account deletion link!', 'success');
        return back()->with('status', 'We have emailed your account deletion link!');
    }

    public function verifyDelete($token)
    {
        $user = User::where('delete_token', hash('sha256', $token))
            ->where('delete_token_expires', '>', now())
            ->firstOrFail();

        // Delete user account
        $user->delete();
        toast('Delete Account Success!!!', 'success');

        return redirect('/account/delete')->with('status', 'Your account has been deleted.');
    }

    public function getProvinces()
    {
        $apiKey = env('RAJAONGKIR_APIKEY');
        $response = Http::withHeaders([
            'key' => $apiKey,
        ])->get('https://pro.rajaongkir.com/api/province');
        // return response()->json($response);\\

        // Periksa apakah permintaan berhasil
        if ($response->successful()) {
            // Mendapatkan data dari respons JSON
            $data = $response->json();

            // Periksa apakah atribut 'rajaongkir' dan 'results' ada dalam respons
            if (isset($data['rajaongkir'], $data['rajaongkir']['results'])) {
                // Ambil data provinsi dari hasil respons
                $provinces = $data['rajaongkir']['results'];
                return response()->json($provinces);

                // Iterasi melalui setiap provinsi dan simpan ke dalam tabel provinces
                // foreach ($provinces as $province) {
                //     Province::create([
                //         'name'        => $province['province'],
                //     ]);
                // }
            } else {
                // Tangani kesalahan jika respons tidak mengandung data yang diharapkan
                // Misalnya, jika format respons tidak sesuai dengan yang diharapkan
                return response()->json(['error' => 'Invalid response format'], 500);
            }
        } else {
            // Tangani kesalahan jika permintaan gagal
            return response()->json(['error' => 'Failed to fetch provinces'], $response->status());
        }
    }

    public function getCities()
    {
        $apiKey = env('RAJAONGKIR_APIKEY');
        $response = Http::withHeaders([
            'key' => $apiKey,
        ])->get('https://pro.rajaongkir.com/api/city');
        // return response()->json($response);
        // Periksa apakah permintaan berhasil
        if ($response->successful()) {
            // Mendapatkan data dari respons JSON
            $data = $response->json();
            // return response()->json(['data' => $data], 200);


            // Periksa apakah atribut 'rajaongkir' dan 'results' ada dalam respons
            if (isset($data['rajaongkir'], $data['rajaongkir']['results'])) {
                // Ambil data provinsi dari hasil respons
                $cities = $data['rajaongkir']['results'];

                // Iterasi melalui setiap provinsi dan simpan ke dalam tabel cities
                foreach ($cities as $province) {
                    City::create([
                        'province_id' => $province['province_id'],
                        'name'        => $province['city_name'],
                        'type'        => $province['type'],
                    ]);
                }
                return response()->json(['message' => 'Successfully'], 200);
            } else {
                // Tangani kesalahan jika respons tidak mengandung data yang diharapkan
                // Misalnya, jika format respons tidak sesuai dengan yang diharapkan
                return response()->json(['error' => 'Invalid response format'], 500);
            }
        } else {
            // Tangani kesalahan jika permintaan gagal
            return response()->json(['error' => 'Failed to fetch cities'], $response->status());
        }
    }

    public function getKecamatan()
    {
        set_time_limit(0); // Menghapus batas waktu eksekusi

        try {
            // Ambil semua kota
            $response = Http::withHeaders([
                'key' => env('RAJAONGKIR_APIKEY'),
            ])->get('https://pro.rajaongkir.com/api/city');

            if ($response->successful()) {
                $cities = $response->json()['rajaongkir']['results'];

                $chunks = array_chunk($cities, 10); // Membagi kota menjadi batch 10

                foreach ($chunks as $chunk) {
                    foreach ($chunk as $city) {
                        // Ambil semua kecamatan untuk setiap kota
                        $subdistrictResponse = Http::withHeaders([
                            'key' => env('RAJAONGKIR_APIKEY'),
                        ])->timeout(60) // Menambah timeout menjadi 60 detik
                            ->retry(3, 2000) // Mencoba kembali hingga 3 kali dengan jeda 2 detik
                            ->get('https://pro.rajaongkir.com/api/subdistrict', [
                                'city' => $city['city_id'],
                            ]);


                        if ($subdistrictResponse->successful()) {
                            $subdistricts = $subdistrictResponse->json()['rajaongkir']['results'];

                            foreach ($subdistricts as $subdistrict) {
                                Subdistrict::create([
                                    'province_id'    => $subdistrict['province_id'],
                                    'city_id'        => $subdistrict['city_id'],
                                    'name'           => $subdistrict['subdistrict_name'],
                                    'type'           => $subdistrict['type'],
                                ]);
                            }
                        }
                    }
                }

                return response()->json(['message' => 'Successfully fetched and saved all subdistricts'], 200);
            } else {
                return response()->json(['error' => 'Failed to fetch cities from API'], 500);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
