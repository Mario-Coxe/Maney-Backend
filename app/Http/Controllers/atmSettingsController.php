<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;

class AtmSettingsController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'phone' => 'required|string|unique:agents|max:20',
            'password' => 'required|string',
        ]);

        try {
            $userExists = $this->checkUserExists($request->input('phone'));
            if ($userExists) {
                return $this->getResponse('O número já existe!', 201);
            } else {
                $agent = $this->createAgent($request->all());

                return $this->getResponse('Agente criado com sucesso!', 201);
            }
        } catch (\Throwable $th) {
            return $this->getResponse('Erro ao criar o usuário', 500, $th->getMessage());
        }
    }

    public function login(Request $request)
    {
        $user = Agent::where('phone', $request['phone'])->first();
        if (is_null($user) || !Hash::check($request['password'], $user->password)) {
            return $this->getResponse('Usuário não encontrado ou senha incorreta!', 401);
        }
        $this->updateState($user,'activo');
        $token = $user->createToken('auth_token')->plainTextToken;
      
        return json_encode([
            'access_token' => $token,
            'token_type' => 'Bearer'

    ],200);
    }

    private function checkUserExists($phone)
    {
        return Agent::where('phone', $phone)->exists();
    }

    private function createAgent($data)
    {
        $agent = Agent::create([
            'nome' => $data['nome'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'address' => $data['address'],
            'created_at' => now(),
            'updated_at' => now(),
            'servico' => 'inativo',
        ]);

        return $agent;
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

    public function updateState($user, $sms)
    {
        try {
            //code...
            $user->servico = $sms;
            $user->updated_at=now();
            $user->save();
            return $this->getResponse('Agente '.$sms.' com sucesso', 200);
        } catch (\Throwable $th) {
            return $this->getResponse('Ativação falhou', 401, $th->getMessage());
        }
    }
    
    public function logout(Request $request)
    {
        $user = Agent::where('1')->first();
        if($user){
            $this->updateState($user, 'inativo');
            auth()->user()->tokens()->delete();
            $response = [
                "msg" => "Logout realizado" . $request['phone']
            ];
        }
       
        return json_encode($response, 200);
    }
    

}
