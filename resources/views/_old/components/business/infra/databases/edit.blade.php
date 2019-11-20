@extends('adminlte::page')

@section('title', 'Databases')

@section('content_header')
    <h1>Databases - Editar</h1>
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
    Edit Database
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
      <form method="post" action="{{ route('databases.update', $database->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Database Name:</label>
          <input type="text" class="form-control" name="name" value={{ $database->name }} />
        </div>
        <div class="form-group">
          <label for="price">Database Email :</label>
          <input type="text" class="form-control" name="email" value={{ $database->email }} />
        </div>
        <div class="form-group">
          <label for="quantity">Database Telephone:</label>
          <input type="text" class="form-control" name="telephone" value={{ $database->telephone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection