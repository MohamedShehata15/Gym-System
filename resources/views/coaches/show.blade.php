@extends('layouts.app')

@section('content')

@php
    if(Auth::user()->hasRole('coach'))
        $coach = Auth::user();
@endphp

<div class="card-body text-center mydiv">
    <div class="text-center mb-2">
        <img class="profile-user-img img-fluid img-circle"
        src="{{asset('images/'. $coach->avatar . '')}}" alt="User profile picture">
    </div>
    <p class="mb-4">{{$coach->name}}</p>
    <a class="btn btn-app" href="{{route('coaches.profile', ['id' => $coach->id])}}">
        <i class="fas fa-user"></i> Profile
    </a>
    <a class="btn btn-app" href="{{route('coaches.edit', ['id' => $coach->id])}}">
        <i class="fas fa-edit"></i> Edit Profile
    </a>
    <a class="btn btn-app" href="{{route('coaches.password', ['id' => $coach->id])}}">
        <i class="fas fa-lock"></i> Change Password
    </a>
    <a class="btn btn-app" href="{{route('coaches.sessions', ['id' => $coach->id])}}">
        <i class="fas fa-calendar-check"></i> Sessions
    </a>
</div>
@endsection
