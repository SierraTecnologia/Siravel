@extends('layouts.dashboard.app')
@section('content')
<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h3>All Roles</h3>
		</div>
		<div class="box-body">
			<a href="{{url('admin/roles/create')}}" class = "btn btn-success"><i class="fa fa-plus fa-md" aria-hidden="true"></i> {!! trans('words.new') !!}</a>
			<table class="table table-striped">
				<head>
					<th>Role</th>
					<th>{!! trans('words.actions') !!}</th>
				</head>
				<tbody>
					@foreach($roles as $role)
					<tr>
						<td>{{$role->name}}</td>
						<td>
							<a href="{{url('/admin/roles/edit')}}/{{$role->id}}" class = "btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							<a href="{{url('/admin/roles/delete')}}/{{$role->id}}" class = "btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection
