<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtmAgent;
use App\Models\Atm;
use App\Http\Controllers\Throwable;

class AgentAtmsController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'atm_id' => 'required|string',
            'user_id' => 'required|string',
        ]);


        $atmAgent = $this->createAtmAgent($request->all());
        $id = $request['atm_id'];
        $this->updateStatus($id);
        return $this->getResponse('Atm Atribuido com sucesso!', 201);
    }
    private function createAtmAgent($data)
    {
        $atmAgent = AtmAgent::create([
            'id' => $data['id'],
            'atm_id' => $data['atm_id'],
            'user_id' => $data['user_id'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return $atmAgent;
    }
    private function getResponse($message, $statusCode, $error = null)
    {
        $response = [
            'message' => $message,
        ];

        if ($error) {
            $response['error'] = $error;
        }

        return response()->json($response, $statusCode);
    }
    public function getAtmById($user_id)
    {
        $atm = AtmAgent::where('user_id', '=', $user_id)
            ->with('user')
            ->with('atm')
            ->get();
        return response()->json($atm);
    }
    public function updateStatus($id,)
    {
        $atmUser = Atm::find($id);
        try {
            $atmUser->status = 1;
            $atmUser->save();
        } catch (\Throwable $th) {
            return response()->json(["error" => $th]);
        }
    }
}
