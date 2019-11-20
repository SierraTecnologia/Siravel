@extends('adminlte::page')

@section('title', 'Databases')

@section('content_header')
    <h1>Databases</h1>
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

  @include('databases.table', ['databases' => $databases])
  
<div>
@endsection