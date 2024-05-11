<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NetSms
{


    public function enviarSms($chaveEntidade, $destinatarios, $descricaoSms)
    {
        $data = [
            'mensagem' => [
                'accao' => 'enviar_sms',
                'chave_entidade' => $chaveEntidade,
                'destinatario' => $destinatarios,
                'descricao_sms' => $descricaoSms,
            ],
        ];
        $response = Http::post(env('NETSMS_URL'), $data);

        return $response->json();
    }

    public function consultarSaldo($telefone, $senha)
    {
        $data = [
            'saldo' => [
                'accao' => 'consultar_saldo',
                'telefone' => $telefone,
                'senha' => $senha,
            ],
        ];

        $response = Http::post($this->apiUrl, $data);

        return $response->json();
    }
}
