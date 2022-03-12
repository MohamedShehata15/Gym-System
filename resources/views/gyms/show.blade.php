@extends('layouts.app')

@section('content')

<div class="p-16 bg-surface-secondary">
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <!-- Component -->
            <div class="card shadow">
            <div class="card-header bg-secondary">
            <h3 class="d-block text-center h5 mb-0">{{$gym->name}}</h3>
          <div class="card-tools">
            <a href="{{route('gyms.index')}}" class="badge badge-primary">Back</a>
          </div>
        </div>
        <div class="card-body bg-dark">
                <div class="text-center">
          <img src="../uploads/gyms/{{$gym->image}}" alt="notFounded" class="w-25 rounded-circle shadow">
          <div class="d-grid gap-3 my-4">
                <div class="p-2 bg-light border">
                  <li class="list-group-item d-flex align-items-center justify-content-between">
                  <b>Gym Name </b> <a>{{$gym->name}}</a>
                  </li>
               </div>
               <div class="p-2 bg-light border">
                  <li class="list-group-item d-flex align-items-center justify-content-between">
                  <b>Gym Revenue</b> <a> {{$gym->revenue * 0.01}} $</a>
                  </li>
               </div>
               <div class="p-2 bg-light border">
               <li class="list-group-item d-flex align-items-center justify-content-between ">
                <b>Gym Manager</b> <ul class="list-unstyled text-primary">
                @foreach ($managers as $manager )
                    <li>{{$manager->name}}</li>
                    @endforeach
                </ul>
            </li>
               </div>
          </div>
        </div>
        <div class="card-footer text-center bg-secondary">
          Our Gym System 
        </div> 
    </div>
    </div> 
    </div>
    </div> 
    </div>

@endsection