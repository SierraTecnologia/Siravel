@extends('cms::layouts.dashboard')

@section('pageTitle') Products @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('siravel::products.breadcrumbs', ['location' => ['create']])

        {!! Form::open(['route' => \Illuminate\Support\Facades\Config::get('cms.backend-route-prefix', 'cms').'.products.store', 'files' => true]) !!}

            {!! FormMaker::setColumns(2)->fromTable('products', \Illuminate\Support\Facades\Config::get('siravel.forms.details.identity')) !!}
            {!! FormMaker::setColumns(2)->fromTable('products', \Illuminate\Support\Facades\Config::get('siravel.forms.details.price')) !!}

            {!! FormMaker::setColumns(2)->fromTable('products', \Illuminate\Support\Facades\Config::get('siravel.forms.details.content')) !!}

            {!! FormMaker::setColumns(2)->fromTable('products', \Illuminate\Support\Facades\Config::get('siravel.forms.details.seo')) !!}
            {!! FormMaker::setColumns(2)->fromTable('products', \Illuminate\Support\Facades\Config::get('siravel.forms.details.options')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::previous() !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>

@endsection
