<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Repositories\Interfaces\SubscriptionRepositoryInterface;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    public function create(array $data): Subscription
    {
        return Subscription::create($data);
    }

    public function findByToken(string $token): ?Subscription
    {
        return Subscription::where('token', $token)->first();
    }

    public function confirmSubscription(Subscription $subscription): bool
    {
        $subscription->confirmed = true;
        return $subscription->save();
    }

    public function getConfirmedSubscriptions(): iterable
    {
        return Subscription::where('confirmed', true)->get();
    }

    public function updateLastPrice(Subscription $subscription, string $price): bool
    {
        $subscription->last_price = $price;
        return $subscription->save();
    }
}
