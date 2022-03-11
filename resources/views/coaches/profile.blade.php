@extends('layouts.app')

@section('content')

<div class="p-16 bg-surface-secondary">
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <!-- Component -->
            <div class="card shadow">
                <div class="card-body bg-dark">
                <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg"
                alt="User profile picture">
                         <h3 class="d-block h5 mb-0">{{$coach->name}}</h3>
             <div class="d-grid gap-3 my-4">
                <div class="p-2 bg-light border">
                  <li class="list-group-item d-flex align-items-center justify-content-between">
                  <b>Email</b> <a>{{$coach->email}}</a>
                  </li>
               </div>
               <div class="p-2 bg-light border">
               <li class="list-group-item d-flex align-items-center justify-content-between">
                <b>National ID</b> <a>{{$coach->national_id}}</a>
               </li>
               </div>

               <div class="p-2 bg-light border">
               <li class="list-group-item d-flex align-items-center justify-content-between ">
                <b>Gyms</b> <ul class="list-unstyled text-primary">
                    @foreach($coach->coachGyms as $gym) 
                    <li>{{$gym->name}}</li>
                    @endforeach
                </ul>
            </li>
               </div>

        </div>

        <a href="{{route('coaches.edit', ['id' => $coach->id])}}" class="btn btn-success btn-block offset-3 col-6"><b>Edit</b></a>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
