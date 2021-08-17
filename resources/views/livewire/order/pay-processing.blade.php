<div class="order-pay-processing" wire:poll>
    <h5>@lang('Reference'): {{ $reference }}</h5>
    <p>@lang('The order status payment is:')</p>
    <span class="order-pay-processing__status {{ $class }}">@lang($label)</span>
</div>
