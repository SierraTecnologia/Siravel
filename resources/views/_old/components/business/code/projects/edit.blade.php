@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')
    <h1>Projects - Editar</h1>
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
    Edit Project
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
      <form method="post" action="{{ route('Projects.update', $Project->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Project Name:</label>
          <input type="text" class="form-control" name="name" value={{ $Project->name }} />
        </div>
        <div class="form-group">
          <label for="price">Project Email :</label>
          <input type="text" class="form-control" name="email" value={{ $Project->email }} />
        </div>
        <div class="form-group">
          <label for="quantity">Project Telephone:</label>
          <input type="text" class="form-control" name="telephone" value={{ $Project->telephone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection