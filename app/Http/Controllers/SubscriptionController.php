<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function subscribe(SubscriptionRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->subscriptionService->subscribe($data['ad_url'], $data['email']);

        return response()->json([
            'success' => true,
            'message' => 'Subscription successful. Please check your email.'
        ]);
    }

    public function confirm($token): View
    {
        $this->subscriptionService->confirmSubscription($token);

        return view('confirm');
    }
}
