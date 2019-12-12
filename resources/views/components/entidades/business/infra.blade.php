@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @include('users.numbers', [
        'collaborators' => $collaborators,
        'sshKeys' => $sshKeys,
        'projects' => $projects,
        'issues' => $issues
    ])

    Ultimos Commits

    Status dos Ambientes

    Tarefas

    Projetos
@stop