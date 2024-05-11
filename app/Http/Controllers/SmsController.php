<?php
use App\Services\NetSms;

class SmsController extends Controller
{
    private $netSms;

    public function __construct(NetSms $netSms)
    {
        $this->netSms = $netSms;
    }

    public function sendSmsEmMassa(Request $request)
    {
        $chaveEntidade = env('NETSMS_KEY');
        $destinatarios = $request->input('destinatarios');
        $descricaoSms = $request->input('descricao_sms');

        $response = $this->netSms->enviarSms($chaveEntidade, $destinatarios, $descricaoSms);

        return json_encode($response);
    }

    public function sendSms($destinatario,$descricaoSms)
    {
        $chaveEntidade = env('NETSMS_KEY');

        $response = $this->netSms->enviarSms($chaveEntidade, $destinatario, $descricaoSms);

        return json_encode($response);
    }

    public function checkBalance(Request $request)
    {
        $telefone = $request->input('telefone');
        $senha = $request->input('senha');

        $response = $this->netSms->consultarSaldo($telefone, $senha);

        return json_encode($response);
    }
}
