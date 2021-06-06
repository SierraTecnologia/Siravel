@extends('layouts.dashboard')

@section('pageTitle') Coupons: Create @stop

@section('content')

    <div class="col-md-12 raw-margin-top-24">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                {!! Form::open(['route' => config('siravel.backend-route-prefix', 'siravel').'.coupons.store']) !!}

                {!! FormMaker::fromTable("coupons", config('commerce.forms.coupons')) !!}

                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
