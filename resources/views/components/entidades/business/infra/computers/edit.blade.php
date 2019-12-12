@extends('adminlte::page')

@section('title', 'Computers')

@section('content_header')
    <h1>Computers - Editar</h1>
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
    Edit Computer
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
      <form method="post" action="{{ route('computers.update', $computer->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Computer Name:</label>
          <input type="text" class="form-control" name="name" value={{ $computer->name }} />
        </div>
        <div class="form-group">
          <label for="price">Computer Email :</label>
          <input type="text" class="form-control" name="email" value={{ $computer->email }} />
        </div>
        <div class="form-group">
          <label for="quantity">Computer Telephone:</label>
          <input type="text" class="form-control" name="telephone" value={{ $computer->telephone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection