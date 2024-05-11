<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = UserSubscription::all();

        return response()->json($subscriptions);
    }

    public function show($id)
    {
        $subscription = UserSubscription::find($id);

        if (!$subscription) {
            return response()->json([
                'message' => 'Subscription not found'
            ], 404);
        }

        return response()->json($subscription);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'start_date' => 'required|date'
        ]);

        $subscription = new UserSubscription([
            'user_id' => $request->user_id,
            'subscription_plan_id' => $request->subscription_plan_id,
            'start_date' => $request->start_date,
        ]);

        $subscription->save();

        return response()->json([
            'message' => 'Subscription created successfully',
            'subscription' => $subscription
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'start_date' => 'required|date'
        ]);

        $subscription = UserSubscription::find($id);

        if (!$subscription) {
            return response()->json([
                'message' => 'Subscription not found'
            ], 404);
        }

        $subscription->user_id = $request->user_id;
        $subscription->subscription_plan_id = $request->subscription_plan_id;
        $subscription->start_date = $request->start_date;
        $subscription->save();

        return response()->json([
            'message' => 'Subscription updated successfully',
            'subscription' => $subscription
        ]);
    }

    public function destroy($id)
    {
        $subscription = UserSubscription::find($id);

        if (!$subscription) {
            return response()->json([
                'message' => 'Subscription not found'
            ], 404);
        }

        $subscription->delete();

        return response()->json([
            'message' => 'Subscription deleted successfully'
        ]);
    }
}
