@extends('adminlte::page')

@section('title', 'DatabaseCollections')

@section('content_header')
    <h1>DatabaseCollections - Editar</h1>
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
    Edit DatabaseCollection
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
      <form method="post" action="{{ route('databaseCollections.update', $databaseCollection->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">DatabaseCollection Name:</label>
          <input type="text" class="form-control" name="name" value={{ $databaseCollection->name }} />
        </div>
        <div class="form-group">
          <label for="price">DatabaseCollection Email :</label>
          <input type="text" class="form-control" name="email" value={{ $databaseCollection->email }} />
        </div>
        <div class="form-group">
          <label for="quantity">DatabaseCollection Telephone:</label>
          <input type="text" class="form-control" name="telephone" value={{ $databaseCollection->telephone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection