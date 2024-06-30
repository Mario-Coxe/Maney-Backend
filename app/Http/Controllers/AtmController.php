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
            ->with("street")
            ->with("municipe")
            ->with("bank")
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

    public function updateStatus(Request $request)
    {
        try {
            $atm = Atm::find($request->id);

            if ($atm) {
                $atm->has_cash = $request->input('has_cash');
                $atm->has_paper = $request->input('has_paper');
                $atm->how_many_cash = $request->input('how_many_cash');
                $atm->how_many_paper = $request->input('how_many_paper');
                $atm->save();

                return response()->json(['message' => 'ATM updated successfully', 'data' => $atm]);
            } else {
                return response()->json(['message' => 'ATM not found'], 404);
            }
        } catch (\Exception $e) {
            //Log::error('Error updating ATM: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
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


        //error_log('aqui >>>>>>>>>', $atms);
        $closestAtms = [];
        foreach ($atms as $atm) {
            $closestAtms[] = [
                'id' => $atm->id,
                'name' => $atm->name,
                'latitude' => $atm->latitude,
                'longitude' => $atm->longitude,
                'address' => $atm->address,
                'has_cash' => $atm->has_cash,
                'has_paper' => $atm->has_paper,
                'id_street' => $atm->id_street,
                'id_municipe' => $atm->id_municipe,
                'updated_at' => $atm->updated_at,
                'status' => $atm->status,
                'created_at' => $atm->created_at,
                'munipice' => $atm->munipice,
                'bank' => $atm->bank,
                'distance' => number_format($this->haversineDistance($latitude, $longitude, $atm->longitude, $atm->latitude), 2),
            ];
        }

        // Ordenar os ATMs pela menor distância
        usort($closestAtms, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        // Retornar apenas os 6 ATMs mais próximos
        $closestAtms = array_slice($closestAtms, 0, 6);

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



    public function search($name = null)
    {
        $eventsQuery = Atm::query()
            ->where('status', '=', 1)
            ->with(['street', 'municipe', 'bank']);


        if ($name !== null && trim($name) !== "") {
            $eventsQuery->where('address', 'like', '%' . $name . '%');
        }

        $events = $eventsQuery->orderBy('updated_at', 'desc')->get();

        if ($events->isEmpty() && $name !== null) {
            return response()->json(['message' => 'Nenhum atm encontrado'], 404);
        }

        return response()->json($events, 200);
    }

}
