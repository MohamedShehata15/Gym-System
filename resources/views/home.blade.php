@php
    $logger = Auth::user()->name;

@endphp

@section('title')
Home Page
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid  py-3">
        <h1 class="text-white text-center">Welcome {{$logger}}</h1>
</div>

@endsection
