@extends('layouts.dashboard.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.client') !!}
        </h1>
    </section>
    <div class="content">

        @include('flash::message')

        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('dashboard.clients.show_fields')
                    <a href="{!! route('clients.index') !!}" class="btn btn-default">{!! trans('words.back') !!}</a>
                </div>
            </div>
        </div>
    </div>
    <section class="content-header">
        <h1>
            {!! trans('words.emails') !!}
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('dashboard.emails.table')
            </div>
        </div>
    </div>
    <section class="content-header">
        <h1>
            {!! trans('words.accounts') !!}
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('dashboard.accounts.table')
            </div>
        </div>
    </div>
@endsection
