<?php

namespace App\Models;

use App\Integrations\Payment\Client;
use App\Integrations\Payment\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int          $id
 * @property string       reference
 * @property string       customer_name
 * @property string       customer_email
 * @property string       customer_mobile
 * @property string       customer_surname
 * @property string       customer_document
 * @property string       customer_document_type
 * @property string       customer_address
 * @property string       product_name
 * @property double       product_price
 * @property string       product_quantity
 * @property double       total
 * @property string       request_id
 * @property string       status
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_mobile',
        'customer_surname',
        'customer_document',
        'customer_document_type',
        'customer_address',
        'product_name',
        'product_price',
        'product_quantity',
        'total',

    ];

    const CREATED_STATUS = 'CREATED_STATUS';
    const PENDING_STATUS = 'PENDING_STATUS';
    const PAYED_STATUS = 'PAYED_STATUS';
    const REJECTED_STATUS = 'REJECTED_STATUS';

    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->status = self::CREATED_STATUS;
            $order->reference = 'TEST_' . time();
        });
    }

    public static function findOneByReference(string $reference): Order
    {
        return Order::query()->where('reference', '=', $reference)->first();
    }

    public function getValidatedStatus(): string
    {
        if ($this->status == self::CREATED_STATUS || $this->status == self::PENDING_STATUS) {
            $this->queryStatus();
        }

        return $this->status;
    }

    public function queryStatus()
    {
        $purchase = new Purchase($this);
        $status = $purchase->getStatus();

        if ($status == $purchase->isPending($status)) {
            $this->status = self::PENDING_STATUS;
        }

        if ($status == $purchase->isError($status)) {
            $this->status = self::REJECTED_STATUS;
        }

        if ($status == $purchase->isApproved($status)) {
            $this->status = self::PAYED_STATUS;
        }

        if ($status == $purchase->isSuccess($status)) {
            $this->status = self::CREATED_STATUS;
        }

        $this->save();
    }


}
