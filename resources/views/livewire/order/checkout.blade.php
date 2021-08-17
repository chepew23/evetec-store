<div class="order-checkout">
    <div class="order-checkout__field">
        <label>@lang('order.customer_name')</label>
        <span>{{ $order->customer_name }}</span>
    </div>
    <div class="order-checkout__field">
        <label>@lang('order.customer_email')</label>
        <span>{{ $order->customer_email }}</span>
    </div>
    <div class="order-checkout__field">
        <label>@lang('order.customer_mobile')</label>
        <span>{{ $order->customer_mobile }}</span>
    </div>
    <div class="order-checkout__field">
        <label>@lang('order.customer_surname')</label>
        <span>{{ $order->customer_surname }}</span>
    </div>
    <div class="order-checkout__field">
        <label>@lang('order.customer_address')</label>
        <span>{{ $order->customer_address }}</span>
    </div>
    <div class="order-checkout__field">
        <label>@lang('order.product_name')</label>
        <span>{{ $order->product_name }}</span>
    </div>
    <div class="order-checkout__field">
        <label>@lang('order.product_price')</label>
        <span>{{ $order->product_price }}</span>
    </div>
    <div class="order-checkout__field">
        <label>@lang('order.product_quantity')</label>
        <span>{{ $order->product_quantity }}</span>
    </div>
    <div class="order-checkout__field">
        <label>@lang('order.total')</label>
        <span>{{ $order->total }}</span>
    </div>
    <button class="order-checkout__button" type="button" wire:click="onCheckout('{{ $order->reference }}')">
        @lang('order.buy')
    </button>
</div>
