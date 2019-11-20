@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>Users</h1>
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

    @include('users.numbers', [
        'adminUsers' => $adminUsers->count(),
        'businessUsers' => $businessUsers->count(),
        'businessUsers' => $businessUsers->count(),
        'customerUsers' => $customerUsers
    ])

  {{-- @include('users.table', ['users' => $adminUsers]) --}}

  @include('users.table-business', ['users' => $businessUsers])

  {{-- @include('users.table-business', ['users' => $businessUsers]) --}}
  
<div>
@endsection