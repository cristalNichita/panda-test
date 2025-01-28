<?php

namespace App\Services;

use App\Mail\ConfirmSubscriptionMail;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SubscriptionService
{
    protected $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function subscribe(string $adUrl, string $email): bool
    {
        try {
            $token = Str::random(32);

            $subscription = $this->subscriptionRepository->create([
                'ad_url' => $adUrl,
                'email' => $email,
                'token' => $token,
            ]);

            Mail::to($email)->send(new ConfirmSubscriptionMail($token));

            return true;
        } catch (\Exception $exception) {
            Log::error('[SUBSCRIPTION ERROR] ' . $exception->getMessage());
            return false;
        }
    }

    public function confirmSubscription(string $token): bool
    {
        $subscription = $this->subscriptionRepository->findByToken($token);

        if (!$subscription) {
            throw new \Exception('Subscription not found.');
        }

        return $this->subscriptionRepository->confirmSubscription($subscription);
    }
}
