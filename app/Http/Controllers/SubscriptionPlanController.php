<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        return SubscriptionPlan::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'duration' => 'required'
        ]);

        $plan = SubscriptionPlan::create($request->all());

        return response()->json([
            'message' => 'Subscription Plan created successfully',
            'plan' => $plan
        ], 201);
    }

    public function show($id)
    {
        $subscription = SubscriptionPlan::where('id', $id)->first();

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        return $subscription;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'duration' => 'required'
        ]);

        $subscription = SubscriptionPlan::find($id);

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $subscription->update($request->all());

        return response()->json([
            'message' => 'Subscription Plan updated successfully',
            'plan' => $subscription
        ]);
    }

    public function destroy($id)
    {
        $subscription = SubscriptionPlan::find($id);

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $subscription->delete();

        return response()->json(['message' => 'Subscription Plan deleted successfully']);
    }
}
