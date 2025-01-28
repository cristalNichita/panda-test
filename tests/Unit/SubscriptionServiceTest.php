<?php

namespace Tests\Unit;

use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ConfirmSubscriptionMail;
use Tests\TestCase;
use Mockery;

class SubscriptionServiceTest extends TestCase
{
    public function test_subscribe(): void
    {
        $this->refreshApplication();

        Mail::fake();
        Log::shouldReceive('error')->andReturnNull();

        $repository = Mockery::mock(SubscriptionRepository::class);

        $subscription = new Subscription();
        $subscription->ad_url = 'https://www.olx.ua/d/uk/obyavlenie/nadyniy-trifazniy-generator-ayerbe-8000-h-tx-benzinoviy-honda-IDQto0j.html';
        $subscription->email = 'test@example.com';
        $subscription->token = 'sample-token';

        $repository->shouldReceive('create')->once()->andReturn($subscription);

        $service = new SubscriptionService($repository);

        $result = $service->subscribe(
            'https://www.olx.ua/d/uk/obyavlenie/nadyniy-trifazniy-generator-ayerbe-8000-h-tx-benzinoviy-honda-IDQto0j.html',
            'nikitakristal15@gmail.com'
        );

        $this->assertTrue($result);

        Mail::assertSent(ConfirmSubscriptionMail::class, function ($mail) {
            return $mail->hasTo('nikitakristal15@gmail.com') &&
                $mail->token === 'sample-token';
        });
    }
}
