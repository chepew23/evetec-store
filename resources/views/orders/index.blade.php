<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('order.index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="order-index">
                    <table class="order-index">
                        <thead>
                            <tr>
                                <th>@lang('order.reference')</th>
                                <th>@lang('order.customer_name')</th>
                                <th>@lang('order.customer_surname')</th>
                                <th>@lang('order.customer_document')</th>
                                <th>@lang('order.total')</th>
                                <th>@lang('order.status')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->reference }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_surname }}</td>
                                <td>{{ $order->customer_document_type }} {{ $order->customer_document }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
