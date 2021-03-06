<table class="table table-stripped mb-4">
    <thead>
        <td>Name</td>
        <td>Code</td>
        <td>Price</td>
        <td class="text-right">Quantity</td>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr data-cart-row="{!! $product->cart_id !!}">
                <td>
                    <a href="{{ $product->href }}">{!! $product->name !!}</a>
                    {!! $product->detailsBtn() !!}
                </td>
                <td>{!! $product->code !!}</td>
                <td>${!! $product->price !!}</td>
                <td class="text-right">{!! $product->quantity !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table class="table table-stripped mt-4">
    <tr>
        <td><b>Shipping</b> <span class="shipping-choice"></span></td>
        <td class="text-right">${!! siravel()->checkoutShipping() !!}</td>
    </tr>
    <tr>
        <td><b>Tax</b></td>
        <td class="text-right">${!! siravel()->checkoutTax() !!}</td>
    </tr>
    <tr>
        <td><b>Subtotal</b></td>
        <td class="text-right">${!! siravel()->checkoutSubtotal() !!}</td>
    </tr>

    @if (Session::has('coupon_code'))
    <tr>
        <td><b>Coupon <a href="{{ url(\Illuminate\Support\Facades\Config::get('siravel.store_url_prefix').'/coupon/remove') }}"><span class="fa fa-close"></span></a></b></td>
        <td class="text-right">-${!! siravel()->couponValue() !!}</td>
    </tr>
    @endif

    <tr>
        <td><b>Total</b></td>
        <td class="text-right">${!! siravel()->checkoutTotal() !!}</td>
    </tr>
</table>