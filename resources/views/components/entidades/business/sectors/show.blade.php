@extends('adminlte::page')

@section('title', 'Show Sector')

@section('content_header')
    <h1>Show Sector</h1>
@stop

@section('css')

@stop

@section('js')

@stop

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show Sector</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('orders.index') }}"> Back</a>

            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">
                    Sector Sectors
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('orders.table', ['orders' => $sector->orders()->get()])</h3>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">


        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">Id</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    {{ $sector->id }}
                </blockquote>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">name</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    {{ $sector->name }}
                </blockquote>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">email</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    {{ $sector->email }}
                </blockquote>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">cpf</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    {{ $sector->cpf }}
                </blockquote>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">role_id</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    {{ $sector->role_id }}
                </blockquote>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">created_at</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    {{ $sector->created_at }}
                </blockquote>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">updated_at</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    {{ $sector->updated_at }}
                </blockquote>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">score_points</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    {{ $sector->score_points }}
                </blockquote>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </div>

@endsection