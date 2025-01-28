<?php

namespace App\Console\Commands;

use App\Services\PriceTrackingService;
use Illuminate\Console\Command;

class CheckAdPrices extends Command
{
    protected $signature = 'ads:check-prices';
    protected $description = 'Check ads prices update';
    protected $priceTrackingService;

    public function __construct(PriceTrackingService $priceTrackingService)
    {
        parent::__construct();
        $this->priceTrackingService = $priceTrackingService;
    }

    public function handle(): void
    {
        $this->priceTrackingService->trackPrices();
        $this->info('Prices check successful.');
    }
}
