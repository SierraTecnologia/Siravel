@extends(\Templeiro::loadRelativeView('layouts.store'))

@section('store-content')

    @include(\Templeiro::loadRelativeView('products.featured'))

    <table class="table table-stripped">
        <thead>
            <td>Name</td>
            <td>Code</td>
            <td>Price</td>
            <td class="text-right">Action</td>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><a href="{{ $product->href }}">{!! $product->name !!}</a></td>
                    <td>{!! $product->code !!}</td>
                    <td>${!! $product->price !!}</td>
                    <td class="text-right">{!! $product->addToCartBtn('Add To Cart <span class="fa fa-shopping-cart"></span>', 'btn btn-outline-primary btn-sm') !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
