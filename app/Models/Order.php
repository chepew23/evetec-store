<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_mobile',
        'customer_surname',
        'customer_address',
        'product_name',
        'product_price',
        'product_quantity',
        'total',

    ];

    const CREATED_STATUS = 'CREATED_STATUS';
    const PAYED_STATUS = 'PAYED_STATUS';
    const REJECTED_STATUS = 'REJECTED_STATUS';

    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->status = self::CREATED_STATUS;
            $order->reference = sha1($order->id);
        });
    }
}
