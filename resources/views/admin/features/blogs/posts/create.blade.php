@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-default">
                    <div class="box-header panel-heading card-header">
                        <h2>
                            Create Post

                            <a href="{{ url('admin/posts') }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>

                    <div class="box-body panel-body card-body">
                        {!! Form::open(['url' => '/admin/posts', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                            @include('admin.posts._form')

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
