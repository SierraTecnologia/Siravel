@extends('layouts.dashboard.app')
@section('title','Dashboard')
@section('content')
<section class="content-header">
	<h1>
		{!! trans('words.dashboard') !!}
		<small>{!! trans('words.controlPane') !!}</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('words.home') !!}</a></li>
		<li class="active">{!! trans('words.dashboard') !!}</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>{{$users}}</h3>
					<p>{!! trans('words.users') !!}</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-stalker"></i>
				</div>
				<a href="{{url('users')}}" class="small-box-footer">{!! trans('words.moreInfo') !!} <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h3>{{$roles}}</h3>
					<p>{!! trans('words.roles') !!}</p>
				</div>
				<div class="icon">
					<i class="fa fa-user-plus"></i>
				</div>
				<a href="{{url('roles')}}" class="small-box-footer">{!! trans('words.moreInfo') !!} <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>{{$permissions}}</h3>
					<p>{!! trans('words.permissions') !!}</p>
				</div>
				<div class="icon">
					<i class="fa fa-key"></i>
				</div>
				<a href="{{url('permissions')}}" class="small-box-footer">{!! trans('words.moreInfo') !!} <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
</section>
@endsection
