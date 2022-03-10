@extends('layouts.app')

@section('content')

<div class="card card-primary card-outline text-dark">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg"
                alt="User profile picture">
        </div>
        <h3 class="profile-username text-center">{{$coach->name}}</h3>
        <p class="text-muted text-center">Coach</p>
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{$coach->email}}</a>
            </li>
            <li class="list-group-item">
                <b>National ID</b> <a class="float-right">{{$coach->national_id}}</a>
            </li>
            <li class="list-group-item d-flex align-items-center justify-content-between">
                <b>Gyms</b> <ul class="float-right list-unstyled text-primary">
                    @foreach($coach->coachGyms as $gym) 
                    <li>{{$gym->name}}</li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <a href="{{route('coaches.edit', ['id' => $coach->id])}}" class="btn btn-primary btn-block"><b>Edit</b></a>
    </div>

</div>

@endsection
