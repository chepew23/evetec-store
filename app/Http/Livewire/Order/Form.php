<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Form extends Component
{
    public $customer_name;
    public $customer_surname;
    public $customer_document_type;
    public $customer_document;
    public $customer_email;
    public $customer_mobile;
    public $customer_address;
    public $product_name;
    public $product_quantity;
    public $product_price;
    public $productPriceLabel;

    protected $rules = [
        'customer_name' => 'required',
        'customer_surname' => 'required',
        'customer_document_type' => 'required',
        'customer_document' => 'required',
        'customer_email' => 'required',
        'customer_mobile' => 'required',
        'customer_address' => 'required',
        'product_quantity' => 'required|integer|min:1',
    ];

    public function mount()
    {
        $product = Product::query()->inRandomOrder()->first();
        $this->product_name = $product->name;
        $this->product_price = $product->price;
        $this->productPriceLabel = "$ " . number_format($product->price, 2) . " COP";
    }



    public function submit()
    {
        $total = $this->product_price * $this->product_quantity;
        $values = [
            'customer_name' => $this->customer_name,
            'customer_surname' => $this->customer_surname,
            'customer_document_type' => $this->customer_document_type,
            'customer_document' => $this->customer_document,
            'customer_email' => $this->customer_email,
            'customer_mobile' => $this->customer_mobile,
            'customer_address' => $this->customer_address,
            'product_name' => $this->product_name,
            'product_price' => $this->product_price,
            'product_quantity' => $this->product_quantity,
            'total' => $total,
        ];
        $order = new Order($values);
        $order->save();

        return redirect()->to(route('orders.checkout', ['reference' => $order->reference]));
    }

    public function render()
    {
        return view('livewire.order.form');
    }
}
