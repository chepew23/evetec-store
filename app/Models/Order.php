<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const CREATED_STATUS = 'CREATED_STATUS';
    const PAYED_STATUS = 'PAYED_STATUS';
    const REJECTED_STATUS = 'REJECTED_STATUS';

    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->status = self::CREATED_STATUS;
        });
    }
}
