<?php


namespace App\Integrations\Payment;


use Dnetix\Redirection\PlacetoPay;
use Exception;

class Client
{
    /** @var PlacetoPay $placetopay */
    protected $placetopay;

    const INTERNAL_ERROR_STATUS = 'INTERNAL_ERROR_STATUS';
    const REQUEST_ID_FAILED_STATUS = 'REQUEST_ID_FAILED_STATUS';
    const RESQUEST_IS_SUCCESS_SATATUS =  'RESQUEST_IS_SUCCESS_SATATUS';

    public function __construct()
    {
        $this->placetopay = new PlacetoPay([
            'login' => config('placetopay.login'),
            'tranKey' => config('placetopay.tranKey'),
            'url' => config('placetopay.url_base'),
            'rest' => [
                'timeout' => config('placetopay.timeout', 45),
                'connect_timeout' => config('placetopay.connect_timeout', 30)
            ]
        ]);
    }

    public function queryByRequestId($requestId)
    {
        try {
            $response = $this->placetopay->query($requestId);
        } catch (\Exception $e) {
            return self::INTERNAL_ERROR_STATUS;
        }

        $status = $response->status();

        if ($status->isFailed() && $status->reason() == 0) {
            return self::REQUEST_ID_FAILED_STATUS;
        }

        if ($status->isSuccessful()) {
            return self::RESQUEST_IS_SUCCESS_SATATUS;
        }
    }

}
