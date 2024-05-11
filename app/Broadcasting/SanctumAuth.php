<?php
namespace App\Broadcasting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanctumAuth
{
    /**
     * Authenticate the request for a given channel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool|array
     */
    public function authorize(Request $request)
    {
        if ($request->hasHeader('Authorization')) {
            $token = str_replace('Bearer ', '', $request->header('Authorization'));

            if (Auth::guard('web')->check() || Auth::guard('sanctum')->once(['api_token' => $token])) {
                return ['user_id' => Auth::id()];
            }
        }

        return false;
    }
}
