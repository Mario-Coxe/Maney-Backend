<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Endereco;
use App\Models\EnderecoUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function register(Request $request)
    {


        // Validação dos dados enviados pelo usuário
        $this->validate($request, [
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|unique:users|max:15',
        ]);



        // Criação do usuário
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'ativo'=>true
        ]);

         // Atribui o role ao usuário.
         $role = Role::findByName('cliente'); // ou qualquer role que você queira atribuir
         $user->assignRole($role);

        // Retorno de uma resposta de sucesso com o usuário criado
        return json_encode([
            'user' => $user,
            'message' => 'Usuário criado com sucesso!'
        ], 201);
    }


    public function login(Request $request)
    {
        // Validação dos dados enviados pelo usuário
        $this->validate($request, [
            'email' => 'required|string|email|max:20',
            'password' => 'required|string|min:8',
        ]);

        // Tentativa de autenticação do usuário
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Autenticação bem sucedida, retorno do token de acesso
            /** @var \App\Models\MyUserModel $user **/

            $user = Auth::user();
            $token = $user->createToken('auth-token')->accessToken;

            return json_encode([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        } else {
            // Autenticação falhou, retorno de uma mensagem de erro
            return json_encode(['message' => 'Credencias Invalidas'], 401);


        }
    }







    public function getAll()
    {
        $users = User::where('tipo_usuario', 'cliente')->get();

        if ($users->isEmpty()) {
            return json_encode([
                'message' => 'Nenhum usuário cliente encontrado'
            ], 404);
        }

        return json_encode([
            'users' => $users
        ]);
    }


    public function updateClienteInfo(Request $request, User $cliente)
{
    try {
        $this->validate($request, [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|max:255|email',
            'rua' => 'sometimes|string|max:255',
            'numero' => 'sometimes|string|max:10',
            'ponto_referencia' => 'sometimes|string|max:100',
            'bairro' => 'sometimes|string|max:255',
            'municipio' => 'sometimes|string|max:255',
            'provincia' => 'sometimes|string|max:255',
        ]);

        if ($request->has('name')) {
            $cliente->name = $request->name;
        }

        if ($request->has('email')) {
            $cliente->email = $request->email;
        }


      //  echo $user->id; exit;
        $cliente->save();

            return json_encode([
                'message' => 'Informações do usuário atualizadas com sucesso!',
                'user' => $cliente,
                'endereco' => $endereco,
                'endereco_usuario' => $enderecoUsuario,
            ]);
            } catch (\Exception $e) {
            return json_encode([
            'message' => 'Ocorreu um erro ao atualizar as informações do usuário.',
            'error' => $e->getMessage(),
            ]);
            }
    }



    public function updateUserCredentials(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'sometimes|required|string|email|unique:users|max:255',
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
            if ($user->tipo_usuario !== 'cliente') {
                return json_encode([
                    'message' => 'Usuário não é um cliente!'
                ], 400);
            }

            if ($user) {
           // Remover registros na tabela enderecos_usuarios
           $user->enderecoUser()->delete();

           // Remover veículos associados ao usuário
         //  $user->veiculos()->delete();

           // Remover solicitações associadas ao usuário
           $user->solicitacoes()->delete();

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
        $user = User::where('id', $id)->where('tipo_usuario', 'cliente')->firstOrFail();

        if (!$user) {
            return json_encode([
                'message' => 'Usuário não encontrado!'
            ], 404);
        }

       // var_dump($endereco); exit;
        return json_encode([
            'user' => $user,
        ]);
    }catch(Exception $e){
        return json_encode([
            'message' => 'Ocorreu um erro!'
        ], 500);
    }
    }



function getUserInfoByTelefoneOrEmail($telefoneOuEmail)
{
    try{
    $user = User::where('phone', $telefoneOuEmail)
                ->orWhere('email', $telefoneOuEmail)
                ->first();

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

public function newPassword(Request $request, $email)
{
    try {
        $user = User::where('email', $email)->first();

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
