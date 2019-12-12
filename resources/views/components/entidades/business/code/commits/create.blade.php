@extends('adminlte::page')

@section('title', 'Commits')

@section('content_header')
    <h1>Commits - Criar</h1>
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
    Add Commit
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
      <form method="post" action="{{ route('commits.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="price">Email :</label>
              <input type="text" class="form-control" name="email"/>
          </div>
          <div class="form-group">
              <label for="quantity">Telephone:</label>
              <input type="text" class="form-control" name="telephone"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection