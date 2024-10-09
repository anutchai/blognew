@extends('layouts.backend.master')


@section('content')
    @livewire('project.edit',['id'=>$id])
@endsection
