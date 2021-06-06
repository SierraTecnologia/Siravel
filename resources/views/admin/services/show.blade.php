@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Service
        </h1>
    </section>
    <div class="content">
        <div class="box card box-primary card-primary">
            <div class="box-body card-body">
                <div class="row" style="padding-left: 20px">
                    @include('dashboard.services.show_fields')
                    <a href="{!! route('admin.services.index') !!}" class="btn btn-default">{!! trans('words.back') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
