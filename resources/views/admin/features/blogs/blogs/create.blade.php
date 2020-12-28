@extends('layouts.dashboard')

@section('pageTitle') Blog @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('admin.features.blogs.blogs.breadcrumbs', ['location' => ['create']])
    </div>
    <div class="col-md-12">
        {!! Form::open(['route' => 'admin.blog.store', 'class' => 'add', 'files' => true]) !!}

            {!! FormMaker::setColumns(3)->fromTable('blogs', config('siravel.forms.blog.identity')) !!}
            {!! FormMaker::setColumns(2)->fromTable('blogs', config('siravel.forms.blog.content')) !!}
            {!! FormMaker::setColumns(2)->fromTable('blogs', config('siravel.forms.blog.seo')) !!}
            {!! FormMaker::setColumns(2)->fromTable('blogs', config('siravel.forms.blog.publish')) !!}

            <div class="form-group text-right">
                <a href="{!! url('admin/'.'blog') !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
