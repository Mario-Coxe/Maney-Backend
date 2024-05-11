<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historie;
class HistorieController extends Controller
{
    //
    public function getHistoriesAll(){
        try {
            //code...
            $List= Historie::All();
            return json_encode([
                'History' => $List,           
            ], 201);
        } catch (\Throwable $th) {
            return json_encode([
                'erro' =>  $th,           
            ], 201);
        }
      
     
    }
    public function getHistoryByAgent_id($gent_id) {
         
          try {
            //code...
            $history=Historie::where('agent_id','=',$gent_id)->get();
        
            return json_encode([
                'History' => $history,           
            ], 201);
          } catch (\Throwable $th) {
            //throw $th;
          }
    }

    public function newHistory(Request $request){
        try {
            $history=Historie::create([
             'agent_id' => $request->agent_id,
             'name' =>$request->name,
             'address' =>$request->address,
             'has_cash' =>$request->has_cash,
             'has_paper' =>$request->has_paper,
             'created_at' =>now(),
             'updated_at' =>now(),
             'logo'=>$request->logo

            ]);
            return json_encode([           
                'message' => 'histrico criado com sucesso!'
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return json_encode([
                'erro' => $th,
               
            ], 201);
        }
    }

}
