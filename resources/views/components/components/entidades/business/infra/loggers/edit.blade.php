@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>Loggers - Editar</h1>
@stop

@section('css')

@stop

@section('js')

@stop

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Logger
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('Loggers.update', $Logger->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Logger Name:</label>
          <input type="text" class="form-control" name="name" value={{ $Logger->name }} />
        </div>
        <div class="form-group">
          <label for="price">Logger Email :</label>
          <input type="text" class="form-control" name="email" value={{ $Logger->email }} />
        </div>
        <div class="form-group">
          <label for="quantity">Logger Telephone:</label>
          <input type="text" class="form-control" name="telephone" value={{ $Logger->telephone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection