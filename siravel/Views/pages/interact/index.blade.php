@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Interact</h1>
@stop

@section('content')


    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Interact</h2>

                
            </div>

            <div class="pull-right">

                
            </div>

        </div>

    </div>
    @include('siravel::pages.dash.facilitator', [
        // 'models' => $models,
    ])
    @include('siravel::pages.dash.systemdiagnostc', [
        // 'models' => $models,
    ])
    @include('siravel::pages.dash.tools', [
        // 'models' => $models,
    ])
@stop