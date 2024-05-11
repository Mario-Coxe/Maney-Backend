<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Seshac\Otp\Otp;
use App\Services\NetSms;

use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    //
    private $netSms;

    public function __construct(NetSms $netSms)
    {
        $this->netSms = $netSms;
    }


public function login(Request $request)
{
        $user = User::where('phone', $request['phone'])->first();
        if(is_null($user)){
            $response = [
                "msg" => "User não encontrado !"
            ];
            return json_encode($response,401);
        }
        if(!Hash::check($request['password'],$user->password)){
            $response = [
                "msg" => "Senha errada"
            ];
            return json_encode($response,401);
        }

        $user->update([
            'ativo' => true,
            'ultima_atividade' => now(),
        ]);


     
            $usuario = User::where('phone', $request['phone'])->get();
    
            if ($usuario->isEmpty()) {
                return json_encode([
                    'message' => 'Nenhum usuário cliente encontrado'
                ], 404);
            }
    

        $token = $user->createToken('auth_token')->plainTextToken;

        return json_encode([
                'token' => $token,
                'data' => $usuario,
                'token_type' => 'Bearer'

        ],200);
}




public function change_password(Request $request){

   // validate phone and password in body
$fields = $request->validate([
    'email' => 'required',
    'password' => 'required',
    'old_password' => 'required'
]);

// verify old password
$user = User::where('email', $fields['telefone'])->first();


if(Hash::check($fields['old_password'], $user->password)){
    // old password matches
    // change password
    $user->password = bcrypt($fields['password']);
    $user->save();
    return $user;

}else{
    $response = [
        'msg' => "Password antiga doesn't match!",
    ];
    return response($response, 400);
}

}
public function getUsuarioEndereco($id)
    {
        $user = User::find($id);

        if (!$user) {
            return json_encode([
                'message' => 'Usuário não encontrado!'
            ], 404);
        }

      
       // var_dump($endereco); exit;
        return json_encode([
            'user' => $user,
           
        ]);
    }

public function typeOfUser(Resquest $request){
    $userType=User::where('phone','=',$request['phone']);
    
}

public function me(Request $request)
{
        $user =  $request->user();
        //var_dump($this->getUsuarioEndereco($user->id)); exit;
       //var_dump($user->endereco); exit;
        return $this->getUsuarioEndereco($user->id);
}
public function logout(Request $request)
{
    auth()->user()->tokens()->delete();
        $response = [
            "msg" => "Logout realizado"
        ];
        return json_encode($response,200);
}





}
