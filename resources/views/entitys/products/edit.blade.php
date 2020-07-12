@extends('siravel::layouts.dashboard')

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ Siravel::moduleAsset('siravel', 'css/store.css', 'text/css') }}">
@stop

@section('pageTitle') Products @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('siravel::products.breadcrumbs', ['location' => ['edit']])

        @include('siravel::products.tabs', $tabs)
    </div>

@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Siravel::moduleAsset('siravel', 'js/products.js', 'application/javascript')) !!}

@endsection