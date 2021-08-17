<?php


namespace App\Integrations\Payment;


use App\Models\Order;
use Exception;

class Purchase
{
    protected $client;
    protected $order;

    public function __construct(Order $order)
    {
      $this->client =  new Client();
      $this->order = $order;

    }

    public function checkout(): ?string
    {
        $response = $this->client->request($this->getRequest());
        if (!$response->isSuccessful()) {
            dd($response);
        }

        $this->order->request_id = $response->requestId();
        $this->order->save();
        return $response->processUrl();
    }

    public function getRequest(): array
    {
        $expirationDate = date('c', strtotime('+15 minute'));
        $customer = [
            'name' => $this->order->customer_name,
            'surname' => $this->order->customer_surname,
            'email' => $this->order->customer_email,
            'mobile' => $this->order->customer_mobile,
            'document' => $this->order->customer_document,
            'documentType' => $this->order->customer_document_type,
            'address' => ['street' => $this->order->customer_address, 'country' => 'CO']
        ];

        $request = [
            'locale' => 'es_CO',
            'payer' => $customer,
            'buyer' => $customer,
            'payment' => [
                'reference' => $this->order->reference,
                'description' => $this->order->product_name,
                'amount' => [
                    'details' => [['kind' => $this->order->name, 'amount' => $this->order->product_quantity]],
                    'currency' => 'COP',
                    'total' => $this->order->total
                ],
                'items' => [
                    [
                        'name' => $this->order->name,
                        'category' => 'all',
                        'qty' => $this->order->product_quantity,
                        'price' => $this->order->product_price
                    ]
                ],
                'allowPartial' => false
            ],
            'expiration' => $expirationDate,
            'returnUrl' => route('orders.pay_processing', ['reference' => $this->order->reference]),
            'cancelUrl' => '',
            'skipResult' => false,
            'noBuyerFill' => false,
            'captureAddress' => false,
            'paymentMethod' => null,
        ];

        return $request;
    }

    public function getStatus(): string
    {
        return $this->client->queryByRequestId($this->order->request_id);
    }

    public function isPending($status = null): bool
    {
        if ($status === null) {
            $status = $this->getStatus();
        }
        return $status == Client::REQUEST_IS_PENDING_STATUS;
    }

    public function isError($status = null): bool
    {
        if ($status === null) {
            $status = $this->getStatus();
        }
        return $status == Client::REQUEST_ID_FAILED_STATUS;
    }

    public function isSuccess($status = null): bool
    {
        if ($status === null) {
            $status = $this->getStatus();
        }
        return $status == Client::REQUEST_IS_SUCCESS_STATUS;
    }

    public function isApproved($status = null): bool
    {
        if ($status === null) {
            $status = $this->getStatus();
        }
        return $status == Client::REQUEST_IS_APPROVED_STATUS;
    }
}
