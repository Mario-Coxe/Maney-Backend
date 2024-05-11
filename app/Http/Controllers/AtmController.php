<?php

namespace App\Http\Controllers;

use App\Models\Atm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AtmController extends Controller
{
    // Exibe uma lista dos ATMs
    public function index()
    {
        $atms = Atm::all();
        return response()->json($atms);
    }

    
    public function getAtmByStreet($street){
        return Atm::where('id_street','=',$street)
                  ->where('status','=',1)
                  ->with("category")
                  ->with("street")
                  ->with("municipe")
                  ->get();
    }
    
    public function getAtmByCash(){
        return Atm::where('has_cash','=',1)->get();
        
   }
    public function getAtmByMoney(){
    return Atm::where('has_cash','=','1')->get();
    
}
    // Salva um novo ATM no banco de dados
    public function store(Request $request)
    {
        $atm = Atm::create($request->all());
        return response()->json($atm, 201);
    }

    // Mostra um ATM específico
    public function show(Atm $atm)
    {
        return response()->json($atm);
    }

    // Atualiza um ATM específico no banco de dados
    public function update(Request $request, Atm $atm)
    {
        $atm->update($request->all());
        return response()->json($atm);
    }

    // Remove um ATM específico do banco de dados
    public function destroy(Atm $atm)
    {
        $atm->delete();
        return response()->json(null, 204);
    }

     // Retorna os ATMs com dinheiro dentro de um certo raio
     public function getAtmsWithCashInRadius(Request $request)
     {

        try{
         $user_latitude = $request->input('latitude');
         $user_longitude = $request->input('longitude');
         $radius = $request->input('radius');

            // Filtro para trazer apenas as solicitações dentro da distância informada

            // Filtro para trazer apenas as solicitações dentro da distância informada
            $filtro[] = [
                DB::raw("ST_Distance_Sphere(point(longitude, latitude), point($user_longitude, $user_latitude)) / 1000"),
                '<=',
                $radius,
            ];

            $atm = Atm::where($filtro)
            ->where('has_cash', 1)
                    ->with('category')
                    ->get();

                    return response()->json($atm);
        }catch(Exception $e){
            return response()->json(["error"=>$e]);
        }
     }
     public function updateStatus($id,$has_cash,$has_paper){
         $atmUser=Atm::find($id);
         try {
            //code...
            $atmUser->has_cash=$has_cash;
            $atmUser->has_paper=$has_paper;
            $atmUser->updated_at=now();
            $atmUser->save();
         } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error"=>$th]);
         }
        
     }
}
