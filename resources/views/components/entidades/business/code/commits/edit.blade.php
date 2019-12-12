@extends('adminlte::page')

@section('title', 'Commits')

@section('content_header')
    <h1>Commits - Editar</h1>
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
    Edit Commit
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
      <form method="post" action="{{ route('commits.update', $commit->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Commit Name:</label>
          <input type="text" class="form-control" name="name" value={{ $commit->name }} />
        </div>
        <div class="form-group">
          <label for="price">Commit Email :</label>
          <input type="text" class="form-control" name="email" value={{ $commit->email }} />
        </div>
        <div class="form-group">
          <label for="quantity">Commit Telephone:</label>
          <input type="text" class="form-control" name="telephone" value={{ $commit->telephone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection