<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    public function user()
{
    return $this->belongsTo(User::class);
}

public function subscriptionPlan()
{
    return $this->belongsTo(SubscriptionPlan::class);
}

}
