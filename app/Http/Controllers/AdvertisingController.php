<?php

use Illuminate\Support\Facades\Storage;

namespace App\Http\Controllers;

use App\Models\Advertising;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{
    public function index()
    {
        $Advertising = Advertising::all();
        return response()->json($Advertising);
    }

    public function register(Request $request)
    {
        // Validação
        $request->validate([
            'owner' => 'required|string',
            'address' => 'required|image', 
            'status' => 'required',
        ]);

        // Manipulação do upload da imagem (DK)
        if ($request->hasFile('address')) {
            $image = $request->file('address');
            $fileName = $image->getClientOriginalName(); 

          
            $prefix = '/Anuncios/kzatm/current/';
            $image->move(public_path($prefix), $fileName);

         
            $address = $prefix . $fileName;
        } else {
            // Se der merda
            $address = '';
        }

        // Criando
        $Advertising = Advertising::create([
            'owner' => $request->name,
            'address' => $address,
            'status' => $request->status,
            'created_at' => now(),
        ]);

        // caso der merda
        return json_encode([
            'Advertising' => $Advertising,
            'message' => 'Adicionado com sucesso!'
        ], 201);
    }



    public function show(Advertising $Advertising)
    {
        return response()->json($Advertising);
    }

    public function update(Request $request, Advertising $Advertising)
    {
        $Advertising->update($request->all());
        return response()->json($Advertising);
    }
    public function destroy(Advertising $Advertising)
    {
        $Advertising->delete();
        return response()->json(null, 204);
    }
}
