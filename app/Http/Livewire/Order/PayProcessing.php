<?php

namespace App\Http\Livewire\Order;

use App\Integrations\Payment\Client;
use App\Integrations\Payment\Purchase;
use App\Models\Order;
use Livewire\Component;

class PayProcessing extends Component
{
    public $reference;

    public function mount(string $reference)
    {
    }
    public function render()
    {
        $order = Order::findOneByReference($this->reference);
        $purchase = new Purchase($order);
        $key = 'error';
        $status = $order->getValidatedStatus();

        if ($status == Order::CREATED_STATUS) {
            $key = 'success';
        }

        if ($status == Order::PAYED_STATUS) {
            $key = 'approved';
        }

        if ($status == Order::REJECTED_STATUS) {
            $key = 'error';
        }

        if ($status == Order::PENDING_STATUS) {
            $key = 'pending';
        }

        $order->save();

        $class = "order-pay-processing__status--{$key}";
        $label = "order.{$key}_status";

        return view('livewire.order.pay-processing', compact('status', 'class', 'label'));
    }
}
