<?php

namespace App\Http\Controllers;

use App\Models\Atm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AtmController extends Controller
{

    public function index()
    {
        $atms = Atm::all();
        return response()->json($atms);
    }


    public function getAtmByStreet($street)
    {
        return Atm::where('id_street', '=', $street)
            ->where('status', '=', 1)
            ->with("category")
            ->with("street")
            ->with("municipe")
            ->get();
    }

    public function getAtmByCash()
    {
        return Atm::where('has_cash', '=', 1)->get();
    }
    public function getAtmByMoney()
    {
        return Atm::where('has_cash', '=', '1')->get();
    }

    public function store(Request $request)
    {
        $atm = Atm::create($request->all());
        return response()->json($atm, 201);
    }


    public function show(Atm $atm)
    {
        return response()->json($atm);
    }

    public function update(Request $request, Atm $atm)
    {
        $atm->update($request->all());
        return response()->json($atm);
    }

    public function destroy(Atm $atm)
    {
        $atm->delete();
        return response()->json(null, 204);
    }

    public function updateStatus($id, $has_cash, $has_paper)
    {
        $atmUser = Atm::find($id);
        try {
            //code...
            $atmUser->has_cash = $has_cash;
            $atmUser->has_paper = $has_paper;
            $atmUser->updated_at = now();
            $atmUser->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error" => $th]);
        }
    }


    public function getClosestAtms(Request $request)
    {
        if (!$request->has(['latitude', 'longitude'])) {
            return response()->json(['error' => 'Latitude and longitude parameters are required.'], 400);
        }

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $atms = Atm::where('has_cash', '=', 1)
            ->where('status', '=', 1)
            ->get();

        if ($atms->isEmpty()) {
            return response()->json(['error' => 'No active ATMs with cash available.'], 404);
        }

        foreach ($atms as $atm) {
            $atm->distance = $this->haversineDistance($latitude, $longitude, $atm->longitude, $atm->latitude);
        }

        $closestAtms = $atms->sortBy('distance')->take(5);

        return response()->json($closestAtms);
    }

    private function haversineDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earthRadius = 6371;

        $deltaLatitude = deg2rad($latitude2 - $latitude1);
        $deltaLongitude = deg2rad($longitude2 - $longitude1);

        $a = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) +
            cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
            sin($deltaLongitude / 2) * sin($deltaLongitude / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }
}
