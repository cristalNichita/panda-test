<?php

namespace App\Repositories\Interfaces;

use App\Models\Subscription;

interface SubscriptionRepositoryInterface
{
    public function create(array $data): Subscription;
    public function findByToken(string $token): ?Subscription;
    public function confirmSubscription(Subscription $subscription): bool;
    public function getConfirmedSubscriptions(): iterable;
    public function updateLastPrice(Subscription $subscription, string $price): bool;
}
