@extends('layouts.app')

@section('content')

    <div class="container card card-primary card-outline w-50 text-dark">
        <div class="card-header ">
          <h3 class="card-title">Gym Name:- {{$gym->name}}</h3>
          <div class="card-tools">
            <a href="{{route('gyms.index')}}"" class="badge badge-primary">Back</a>
          </div>
        </div>
        <div class="card-body d-flex justify-content-center align-items-center flex-column">
          <img src="../uploads/gyms/{{$gym->image}}" alt="notFounded" class="w-25 rounded-circle shadow">
          <h3>Gym Name :  {{$gym->name}}</h3>
          <h3>Gym Revenue :  {{$gym->revenue}}</h3>
          <h3>Gym Manager : </h3>
          <ol>
            @foreach ($managers as $manager )

              <li><h4>{{$manager->name}}</h4></li> 
               
            @endforeach
          
          </ol>
        </div>
        <div class="card-footer">
          Our Gym System 
        </div> 
    </div>
     

@endsection