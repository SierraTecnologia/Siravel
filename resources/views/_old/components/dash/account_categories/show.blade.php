@extends('layouts.dashboard.app')

@section('content')
    <section class="content-header">
        <h1>
            Account Category
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('dashboard.account_categories.show_fields')
                    <a href="{!! route('accountCategories.index') !!}" class="btn btn-default">{!! trans('words.back') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
