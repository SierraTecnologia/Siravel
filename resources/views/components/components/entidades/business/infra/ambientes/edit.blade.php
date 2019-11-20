@extends('adminlte::page')

@section('title', 'Ambientes')

@section('content_header')
    <h1>Ambientes - Editar</h1>
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
    Edit Ambiente
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
      <form method="post" action="{{ route('ambientes.update', $ambiente->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Ambiente Name:</label>
          <input type="text" class="form-control" name="name" value={{ $ambiente->name }} />
        </div>
        <div class="form-group">
          <label for="price">Ambiente Email :</label>
          <input type="text" class="form-control" name="email" value={{ $ambiente->email }} />
        </div>
        <div class="form-group">
          <label for="quantity">Ambiente Telephone:</label>
          <input type="text" class="form-control" name="telephone" value={{ $ambiente->telephone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection