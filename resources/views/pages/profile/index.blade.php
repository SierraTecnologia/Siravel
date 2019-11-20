@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('content')


    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Profile</h2>

                
            </div>

            <div class="pull-right">

                
            </div>

        </div>

    </div>
    @include('siravel::pages.profile.portifolio', [
        // 'models' => $models,
    ])
    @include('siravel::pages.profile.sprint', [
        // 'models' => $models,
    ])
    @include('siravel::pages.profile.metrics', [
        // 'models' => $models,
    ])
@stop