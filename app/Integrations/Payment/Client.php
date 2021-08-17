<?php


namespace App\Integrations\Payment;


use Dnetix\Redirection\Entities\Status;
use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Dnetix\Redirection\Message\RedirectResponse;
use Dnetix\Redirection\PlacetoPay;
use Exception;

class Client
{
    /** @var PlacetoPay $placetopay */
    protected $placetopay;

    const INTERNAL_ERROR_STATUS = 'error';
    const REQUEST_ID_FAILED_STATUS = 'failed';
    const REQUEST_IS_PENDING_STATUS =  'pending';
    const REQUEST_IS_SUCCESS_STATUS =  'success';
    const REQUEST_IS_APPROVED_STATUS =  'approved';

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

    public function queryByRequestId($requestId): string
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

        if (in_array($status, [Status::ST_PENDING, Status::ST_PENDING_VALIDATION])) {
            return self::REQUEST_IS_PENDING_STATUS;
        }

        if ($status->isSuccessful()) {
            return self::REQUEST_IS_SUCCESS_STATUS;
        }

        if ($status->isApproved()) {
            return self::REQUEST_IS_APPROVED_STATUS;
        }

        throw new Exception("Response with status don't recognized");
    }

    /**
     * @throws PlacetoPayException
     */
    public function request(array $request): RedirectResponse
    {
        return $this->placetopay->request($request);
    }

}
