<?php

namespace App\Http\Livewire\Order;

use App\Integrations\Payment\Purchase;
use App\Models\Order;
use Livewire\Component;

class Checkout extends Component
{
    public $order;
    public $order_reference;
    public $order_id;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->order_reference = $order->reference;
        $this->order_id = $order->id;
    }

    public function render()
    {
        return view('livewire.order.checkout');
    }

    public function onCheckout(string $reference)
    {
        $order = Order::findOneByReference($reference);
        $purchase = new Purchase($order);
        $processUrl = $purchase->checkout();

        $this->redirect($processUrl);
    }
}
