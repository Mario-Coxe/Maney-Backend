<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtmAgent;
use App\Models\Atm;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Throwable;
class AgentAtmsController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'atm_id' => 'required|string',
            'user_id' => 'required|string',
        ]);
        try {

            $atmAgent = $this->createAtmAgent($request->all());
            $id = $request['atm_id'];
            $this->updateStatus($id);
            return $this->getResponse('Atm Atribuido com sucesso!', 201);
        } catch (Throwable $th) {
            return $this->getResponse('Erro ao Atribuir atm!', 401, $th->getMessage());
        }
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
        $atm = AtmAgent::where('user_id', '=', $user_id)->get();
        return response()->json($atm);
    }
    public function updateStatus($id, )
    {
        $atmUser = Atm::find($id);
        try {
            //code...

            $atmUser->status = 1;
            $atmUser->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error" => $th]);
        }

    }
}
