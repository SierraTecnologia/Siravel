@extends('layouts.dashboard.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{!! trans('words.emails') !!}</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('emails.create') !!}">{!! trans('words.addNew') !!}</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('dashboard.emails.table')
            </div>
        </div>
    </div>
@endsection

