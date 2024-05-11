<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class TypeOfUserController extends Controller
{
    //

    function getTYpeOfUser($phone){
        try {
            //code...
            $user=User::where('phone','=',$phone)->get();
        
            return json_encode([
                'user' => $user,           
            ], 201);
          } catch (\Throwable $th) {
            return json_encode([
                'erro' => $th,           
            ], 402);
          }
    }
}


