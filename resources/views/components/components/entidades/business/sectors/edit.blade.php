@extends('adminlte::page')

@section('title', 'Sectors')

@section('content_header')
    <h1>Sectors - Editar</h1>
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
    Edit Sector
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
      <form method="post" action="{{ route('sectors.update', $sector->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Sector Name:</label>
          <input type="text" class="form-control" name="name" value={{ $sector->name }} />
        </div>
        <div class="form-group">
          <label for="price">Sector Email :</label>
          <input type="text" class="form-control" name="email" value={{ $sector->email }} />
        </div>
        <div class="form-group">
          <label for="quantity">Sector Telephone:</label>
          <input type="text" class="form-control" name="telephone" value={{ $sector->telephone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection