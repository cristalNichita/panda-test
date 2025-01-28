<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\DomCrawler\Crawler;
use App\Mail\PriceChangedMail;

class PriceTrackingService
{
    protected $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function trackPrices(): void
    {
        try {
            $subscriptions = $this->subscriptionRepository->getConfirmedSubscriptions();

            foreach ($subscriptions as $subscription) {
                $currentPrice = $this->fetchPriceFromAd($subscription->ad_url);

                if (!is_null($subscription->last_price) && $subscription->last_price != $currentPrice) {
                    Mail::to($subscription->email)->send(new PriceChangedMail($subscription, $currentPrice));
                }

                $this->subscriptionRepository->updateLastPrice($subscription, $currentPrice);
            }
        } catch (\Exception $e) {
            Log::error('[TRACKING PRICE ERROR] '.$e->getMessage());
        }
    }

    private function fetchPriceFromAd(string $url): string
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->get($url, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                ]
            ]);

            $html = $response->getBody()->getContents();

            $crawler = new Crawler($html);

            $priceElement = $crawler->filter('div[data-testid="ad-price-container"] h3');

            if ($priceElement) {
                return trim($priceElement->text());
            }

            throw new \Exception('Price element not found on the page.');
        } catch (\Exception $e) {
            Log::error('[FETCHING PRICE ERROR] '.$e->getMessage());
            return 'Error';
        }
    }
}
