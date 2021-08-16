<?php

namespace Tests\Unit;


use App\Integrations\Payment\Client;
use Tests\TestCase;

class PaymentClientTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_into_placetopay()
    {
        $placetopay = new Client();
        $randomInt = random_int(0, 10000);
        $status = $placetopay->queryByRequestId($randomInt);

        $this->assertEquals(Client::REQUEST_ID_FAILED_STATUS, $status, "The placetopay client has not been logged.");
    }
}
