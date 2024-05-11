<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Seshac\Otp\Otp;
use App\Models\User;
use App\Mail\EnviarOtp;
use App\Mail\MyMail;
use App\Services\NetSms;
class OtpController extends Controller
{
    private $netSms;

    public function __construct(NetSms $netSms)
    {
        $this->netSms = $netSms;
    }
    public function sendOtp(Request $request)
{
    $fields = $request->validate([
        //'email' => 'required'
        'telefone' => 'required'
    ]);

    //$user = User::where('email', $fields['email'])->first();
    $user = User::where('phone', $fields['telefone'])->first();

    if(is_null($user)){
        $response = [
            'msg' => "Usúario não existe !"
        ];
        return response($response, 400);

    }else{
    $otp =  Otp::setValidity(180)  // tempo que expira o otp em segndos
    ->setLength(6)  // tamanho do otp
    ->setMaximumOtpsAllowed(10) // número de tentativas de erro ao inserir  o otp
    ->setOnlyDigits(true)  // gerar otp com somente digitos ou alfanumerico
    ->setUseSameToken(false) // gerar sempre o mesmo otp
    ->generate($user['phone']); //identificador

    }
    // Envie o código OTP para o usuário usando o email ou número de telefone fornecido.
    // Você também pode armazenar o código OTP no banco de dados para posterior verificação.

    //Mail::to($user['email'])->send(new EnviarOtp($otp->token));
    //echo $otp->token; exit;
    //var_dump($otp); exit;
    $chaveEntidade = env('NETSMS_KEY');
    $destinatario = $user['phone'];
    $descricaoSms = 'Seu código é'. $otp->token;

    $retorno = $this->netSms->enviarSms($chaveEntidade, $destinatario, $descricaoSms);

    if(!$retorno['sucesso']){
        $response = [
            'msg' => "Ocorreu um erro ao enviar a mensagem !"
        ];
        return response($response, 400);
    }

    return json_encode(['message' => 'OTP enviado com sucesso.']);
}

public function verifyOtp(Request $request)
{
    $is_valid = Otp::validate($request->input('telefone'), $request->input('otp'));
    //echo $is_valid->status; exit;
    if ($is_valid) {
        // O código OTP é válido, faça o login do usuário.
        return json_encode(['message' => 'OTP verificado com sucesso.','status'=>1]);
    } else {
        // O código OTP é inválido.
        return json_encode(['error' => 'Código OTP inválido.']);
    }
}


}
