@extends('layouts.dashboard')

@section('pageTitle') Blog @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                @include('siravel::admin.features.blogs.blogs.breadcrumbs', ['location' => ['edit']])
            </div>
            <div class="col-md-6">
                <div class="btn-toolbar float-right mt-2 mb-4">
                    @if (! siravel()->isDefaultLanguage() && $blog->translationData(request('lang')))
                        @if (isset($blog->translationData(request('lang'))->is_published))
                            <a class="btn btn-success ml-1" href="{!! url('blog/'.$blog->translationData(request('lang'))->url) !!}">Live</a>
                        @else
                            <a class="btn btn-outline-success ml-1" href="{!! url('admin/'.'preview/blog/'.$blog->id.'?lang='.request('lang')) !!}">Preview</a>
                        @endif
                        <a class="btn btn-warning ml-1" href="{!! Siravel::rollbackUrl($blog->translation(request('lang'))) !!}">Rollback</a>
                    @else
                        @if ($blog->is_published)
                            <a class="btn btn-success ml-1" href="{!! url('blog/'.$blog->url) !!}">Live</a>
                        @else
                            <a class="btn btn-outline-success ml-1" href="{!! url('admin/'.'preview/blog/'.$blog->id) !!}">Preview</a>
                        @endif
                        <a class="btn btn-warning ml-1" href="{!! Siravel::rollbackUrl($blog) !!}">Rollback</a>
                        <a class="btn btn-outline-secondary ml-1" href="{!! url('admin/'.'blog/'.$blog->id.'/history') !!}">History</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('pedreiro::layouts.tabs', [ 'module' => 'blog', 'item' => $blog ])
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="@if (config('siravel.live-preview', false)) col-md-6 @else col-md-12 @endif">
                {!! Form::model($blog, ['route' => ['admin.blog.update', $blog->id], 'method' => 'patch', 'class' => 'edit', 'files' => true]) !!}

                    <input type="hidden" name="lang" value="{{ request('lang') }}">

                    {!! FormMaker::setColumns(3)->fromObject($blog->asObject(), config('siravel.forms.blog.identity')) !!}

                    <div class="form-group">
                        <label for="Template">Template</label>
                        <select class="form-control" id="Template" name="template">
                            @foreach (BlogService::getTemplatesAsOptions() as $template)
                                @if (! siravel()->isDefaultLanguage() && $blog->translationData(request('lang')))
                                    <option @if($template === $blog->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                                @else
                                    <option @if($template === $blog->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! FormMaker::setColumns(1)->fromObject($blog->asObject(), config('siravel.forms.blog.content')) !!}
                        </div>
                        <div class="col-md-6">
                            @if ($blog->hero_image)
                                <img class="img-thumbnail img-fluid" src="{{ $blog->hero_image_url }}" alt="">
                                <div class="btn-toolbar mt-2" role="toolbar">
                                    <a href="{{ url('admin/'.'hero-images/delete/blog/'.$blog->id) }}" class="btn btn-outline-danger">
                                        <span class="fa fa-fw fa-trash"></span> Delete Image
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-4">
                            {!! FormMaker::setColumns(2)->fromObject($blog->asObject(), config('siravel.forms.blog.seo')) !!}
                        </div>
                    </div>
                    {!! FormMaker::setColumns(2)->fromObject($blog->asObject(), config('siravel.forms.blog.publish')) !!}

                    @include('siravel::admin.features.blocks', ['item' => $blog->asObject()])

                    <div class="form-group text-right">
                        <a href="{!! url('admin/'.'blog') !!}" class="btn btn-secondary raw-left">{{ __('pedreiro::generic.cancel') }}</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
            @if (config('siravel.live-preview', false))
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div id="wrap">
                        @if (! siravel()->isDefaultLanguage())
                            <iframe id="frame" src="{{ url('admin/'.'preview/blog/'.$blog->id.'?lang='.request('lang')) }}"></iframe>
                        @else
                            <iframe id="frame" src="{{ url('admin/'.'preview/blog/'.$blog->id) }}"></iframe>
                        @endif
                    </div>
                    <div id="frameButtons" class="raw-margin-top-16">
                        <button class="btn btn-secondary preview-toggle" data-platform="desktop">Desktop</button>
                        <button class="btn btn-secondary preview-toggle" data-platform="mobile">Mobile</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
