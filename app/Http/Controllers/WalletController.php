<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        return Wallet::all();
    }

    public function show($id)
    {
        $wallet = Wallet::where('user_id', $id)->first();

        if (!$wallet) {
            return response()->json(['message' => 'Wallet not found'], 404);
        }

        return $wallet;
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'balance' => 'required|numeric|min:0'
        ]);

        $wallet = new Wallet([
            'user_id' => $request->user_id,
            'balance' => $request->balance
        ]);

        $wallet->save();

        return response()->json([
            'message' => 'Wallet created successfully',
            'wallet' => $wallet
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        $wallet = Wallet::where('user_id', $id)->first();

        if (!$wallet) {
            return response()->json(['message' => 'Wallet not found'], 404);
        }

        $wallet->balance += $request->amount;
        $wallet->save();

        return response()->json([
            'message' => 'Wallet balance updated successfully',
            'wallet' => $wallet
        ], 200);
    }

    public function destroy($id)
    {
        $wallet = Wallet::where('user_id', $id)->first();

        if (!$wallet) {
            return response()->json(['message' => 'Wallet not found'], 404);
        }

        $wallet->delete();

        return response()->json(['message' => 'Wallet deleted successfully']);
    }
}
