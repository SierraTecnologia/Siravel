@extends('adminlte::page')

@section('title', 'DatabaseCollections')

@section('content_header')
    <h1>DatabaseCollections</h1>
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
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  @include('databaseCollections.table', ['databaseCollections' => $databaseCollections])
  
<div>
@endsection