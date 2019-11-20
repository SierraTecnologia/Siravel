@extends('adminlte::page')

@section('title', 'Show DatabaseCollection')

@section('content_header')
    <h1>Show DatabaseCollection</h1>
@stop

@section('css')

@stop

@section('js')

@stop

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show DatabaseCollection</h2>

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
                    DatabaseCollection DatabaseCollections
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('orders.table', ['orders' => $databaseCollection->orders()->get()])</h3>
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
                    {{ $databaseCollection->id }}
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
                    {{ $databaseCollection->name }}
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
                    {{ $databaseCollection->email }}
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
                    {{ $databaseCollection->cpf }}
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
                    {{ $databaseCollection->role_id }}
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
                    {{ $databaseCollection->created_at }}
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
                    {{ $databaseCollection->updated_at }}
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
                    {{ $databaseCollection->score_points }}
                </blockquote>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </div>

@endsection