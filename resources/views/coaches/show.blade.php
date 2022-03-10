@extends('layouts.app')

@section('content')

<div class="card-body text-center">
    <div class="text-center mb-2">
        <img class="profile-user-img img-fluid img-circle"
            src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="User profile picture">
    </div>
    <p class="mb-4">{{Auth::user()->name}}</p>
    <a class="btn btn-app" href="{{route('coaches.profile')}}">
        <i class="fas fa-user"></i> Profile
    </a>
    <a class="btn btn-app" href="{{route('coaches.edit')}}">
        <i class="fas fa-edit"></i> Edit Profile
    </a>
    <a class="btn btn-app" href="{{route('coaches.password')}}">
        <i class="fas fa-lock"></i> Change Password
    </a>
    <a class="btn btn-app" href="{{route('coaches.sessions')}}">
        <i class="fas fa-calendar-check"></i> Sessions
    </a>
</div>
@endsection
