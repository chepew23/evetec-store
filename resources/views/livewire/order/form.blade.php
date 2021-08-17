<form wire:submit.prevent="submit">
    <div class="order-form">
        <div>
            <input type="hidden" id="id">
            <div class="order-form__input @error('customer_name') order-form__input--error @enderror">
                <label for="customer_name">@lang('customer.name')</label>
                <input name="customer_name" type="text" placeholder="@lang('customer.name_placeholder')" wire:model="customer_name"/>
                @error('customer_name') <span>{{ $message }}</span> @enderror
            </div>
            <div class="order-form__input @error('customer_surname') order-form__input--error @enderror">
                <label for="customer_surname">@lang('customer.surname')</label>
                <input name="customer_surname" type="text" placeholder="@lang('customer.surname_placeholder')" wire:model="customer_surname"/>
                @error('customer_surname') <span>{{ $message }}</span> @enderror
            </div>
            <div class="order-form__input @error('customer_email') order-form__input--error @enderror">
                <label for="customer_email">@lang('customer.email')</label>
                <input name="customer_email" type="text" placeholder="@lang('customer.email_placeholder')" wire:model="customer_email"/>
                @error('customer_email') <span>{{ $message }}</span> @enderror
            </div>
            <div class="order-form__input @error('customer_mobile') order-form__input--error @enderror">
                <label for="customer_mobile">@lang('customer.mobile')</label>
                <input name="customer_mobile" type="tel" placeholder="@lang('customer.mobile_placeholder')" wire:model="customer_mobile"/>
                @error('customer_mobile') <span>{{ $message }}</span> @enderror
            </div>
            <div class="order-form__input @error('customer_address') order-form__input--error @enderror">
                <label for="customer_address">@lang('customer.address')</label>
                <input name="customer_address" type="tel" placeholder="@lang('customer.address_placeholder')" wire:model="customer_address"/>
                @error('customer_address') <span>{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <div class="order-form__product">
                <p>{{ $product_name }}</p>
                <span>@lang('product'): {{ $productPriceLabel }}</span>
                <input type="hidden" name="product_name" wire:model="product_name"/>
                <input type="hidden" name="product_price" wire:model="product_price"/>
            </div>
            <div class="order-form__input @error('product_quantity') order-form__input--error @enderror">
                <label for="product_quantity">@lang('product.quantity')</label>
                <input name="product_quantity" type="number" min="1" placeholder="@lang('product.quantity_placeholder')" wire:model="product_quantity"/>
                @error('product_quantity') <span>{{ $message }}</span> @enderror
            </div>
            <div class="order-form__buttons">
                <button type="reset" class="order-form__reset-btn">@lang('Reset')</button>
                <button type="submit" class="order-form__submit-btn">@lang('Submit')</button>
            </div>
        </div>
    </div>
</form>
