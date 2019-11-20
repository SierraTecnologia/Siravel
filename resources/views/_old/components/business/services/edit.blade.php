@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <h1>Services - Editar</h1>
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
    Edit Service
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
      <form method="post" action="{{ route('services.update', $service->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Service Name:</label>
          <input type="text" class="form-control" name="name" value={{ $service->name }} />
        </div>
        <div class="form-group">
          <label for="price">Service Email :</label>
          <input type="text" class="form-control" name="email" value={{ $service->email }} />
        </div>
        <div class="form-group">
          <label for="quantity">Service Telephone:</label>
          <input type="text" class="form-control" name="telephone" value={{ $service->telephone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection