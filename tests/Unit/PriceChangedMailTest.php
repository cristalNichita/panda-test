<?php

namespace Tests\Unit;

use App\Mail\PriceChangedMail;
use PHPUnit\Framework\TestCase;

class PriceChangedMailTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $mail = new PriceChangedMail('https://www.olx.ua/d/uk/obyavlenie/nadyniy-trifazniy-generator-ayerbe-8000-h-tx-benzinoviy-honda-IDQto0j.html', 2500);

        $this->assertEquals('Price Changed Mail', $mail->envelope()->subject);
        $this->assertEquals('emails.price_changed', $mail->content()->view);
        $this->assertEquals('https://www.olx.ua/d/uk/obyavlenie/nadyniy-trifazniy-generator-ayerbe-8000-h-tx-benzinoviy-honda-IDQto0j.html', $mail->content()->with['adUrl']);
        $this->assertEquals(2500, $mail->content()->with['newPrice']);
    }
}
