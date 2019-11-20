@extends('adminlte::page')

@section('title', 'Languages')

@section('content_header')
    <h1>Languages</h1>
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

  @include('languages.table', ['languages' => $languages])
  
<div>
@endsection