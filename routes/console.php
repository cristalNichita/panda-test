<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\CheckAdPrices;

\Illuminate\Support\Facades\Schedule::command('ads:check-prices')->hourly();
