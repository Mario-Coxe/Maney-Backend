<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validação dos dados enviados pelo usuário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string|unique:users|max:20',
            'password' => 'required|string|min:8',
            'tipo_usuario' => 'required|string',
        ], [
            'phone.unique' => 'O número de telefone já está sendo usado.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // Criação do usuário
        try {
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'tipo_usuario' => $request->tipo_usuario,
                'ativo' => true
            ]);
    
            // Retorno de uma resposta de sucesso com o usuário criado
            return response()->json([
                'user' => $user,
                'message' => 'Usuário criado com sucesso!'
            ], 201);
        } catch (\Exception $e) {
            // Tratamento de erro ao criar o usuário
            return response()->json([
                'message' => 'Erro ao criar o usuário',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    


    public function login(Request $request)
    {

            $user = User::where('email', $request['email'])->first();
            if(is_null($user)){
                $response = [
                    "msg" => "User não encontrado !"
                ];
                return json_encode($response,401);
            }
            if(!Hash::check($request['password'],$user->password)){
                $response = [
                    "msg" => "Ocorreu um erro ao fazer login"
                ];
                return json_encode($response,401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return json_encode([
                    'access_token' => $token,
                    'token_type' => 'Bearer'

            ],200);
    }







    public function getAll()
    {
        $users = User::where('tipo_usuario', 'other')->get();

        if ($users->isEmpty()) {
            return json_encode([
                'message' => 'Nenhum usuário cliente encontrado'
            ], 404);
        }

        return json_encode([
            'users' => $users
        ]);
    }


    public function updateUserCredentials(Request $request, User $user)
    {
        $this->validate($request, [
            'phone' => 'sometimes|required|string|phone|unique:users|max:255',
            'password' => 'sometimes|required|string|min:8',
        ]);

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return json_encode([
            'message' => 'Credenciais do usuário atualizadas com sucesso!',
            'user' => $user
        ]);
    }


    public function deleteUser(Request $request, $id)
    {
        try{
            $user = User::find($id);

            if ($user) {
           // Remover registros na tabela enderecos_usuarios
           // Excluir o usuário
           $user->delete();

        return json_encode([
            'message' => 'Usuário excluído com sucesso!'
        ]);
    } else {
        return json_encode([
            'message' => 'Usuário não encontrado'
        ], 404);
    }

    }catch(Exception $e){
        return json_encode([
            'message' => $e
        ], 404);
    }
    }

    public function getUser($id)
    {
        try {
        $user = User::where('id', $id)->where('tipo_usuario', 'other')->firstOrFail();

        if (!$user) {
            return json_encode([
                'message' => 'Usuário não encontrado!'
            ], 404);
        }

       // var_dump($endereco); exit;
        return json_encode([
            'user' => $user,
            'endereco' => $endereco,
            'tipo_endereco' => $tipoEndereco
        ]);
    }catch(Exception $e){
        return json_encode([
            'message' => 'Ocorreu um erro!'
        ], 500);
    }
    }


    
public function getUserInfoByTelefoneOrEmail($phone)
{
    try{
    $user = User::where('phone', $phone)->get();

    return json_encode([
        'user' => $user
    ]);
    }catch(Exception $e){
        return json_encode([
            'message' => 'Ocorreu um erro!',
            'erro' =>$e
        ], 500);
    }
}

public function newPassword(Request $request, $telefone)
{
    try {
        $user = User::where('phone', $telefone)->first();

        if (!$user) {
            return json_encode([
                'message' => 'Usuário não encontrado'
            ], 404);
        }

        $password = $request->input('password');

        // Verifique se a senha atende aos requisitos desejados
        // Aqui, você pode adicionar suas próprias regras de validação

        // Defina a nova senha para o usuário
        $user->password = Hash::make($password);
        $user->save();

        return json_encode([
            'message' => 'Nova senha definida com sucesso'
        ]);

    } catch (\Exception $e) {
        return json_encode([
            'message' => 'Ocorreu um erro ao definir a nova senha',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
