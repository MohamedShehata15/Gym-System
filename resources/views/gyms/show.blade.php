@extends('layouts.app')

@section('content')

    <div class="card card-primary mt-3 card-outline">
        <div class="card-header">
          <h3 class="card-title">Gym Name:- {{$gym->name}}</h3>
          <div class="card-tools">
            <a href="{{route('gyms.index')}}"" class="badge badge-primary">Back</a>
          </div>
        </div>
        <div class="card-body">
          <h3>Gym image:- {{$gym->name}}</h3>
          <h3>Gym Revenue:- {{$gym->revenue}}</h3>
          <h3>Gym Manager:- {{$gym->staffs_id}}</h3>
        </div>
        <div class="card-footer">
          Our Gym System 
        </div> 
    </div>
     

@endsection