@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class=" mydiv">

<form method="post" action="{{route('city-managers.store')}}" class="row d-flex flex-column justify-content-center align-items-center" enctype="multipart/form-data">
  @csrf

  <div class="text-center">
    <label for="avatar" class="form-label" role="button">
        <img class="profile-user-img img-fluid img-circle" src="{{asset('images/user_avatar.png')}}" alt="User profile picture">
    </label>
    <input type="file" name="avatar" id="avatar" class="d-none" />
  </div>

  <div class="mb-3 col-sm-6">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" aria-describedby="emailHelp" />
  </div>
  <div class="mb-3 col-sm-6">
    <label for="Email" class="form-label">Email</label>
    <input type="email" name="email" id="Email" class="form-control" value="{{old('email')}}" />
  </div>
  <div class="mb-3 col-sm-6">
    <label for="pass" class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control" />
  </div>
  <div class="mb-3 col-sm-6">
    <label for="confirm" class="form-label">Confrim Password</label>
    <input type="password" name="confirm" id="confirm" class="form-control" />
  </div>

  <div class="mb-3 col-sm-6 ">
    <label for="national_id" class="form-label">National_id</label>
    <input type="text" name="national_id" id="national_id" value="{{old('national_id')}}" class="form-control" />
  </div>

 
  <div class="mb-3 col-sm-6" id="cityDiv">
    <label for="city" class="form-label">City</label>
    <select name="city" class="form-control" id="city">
      <option value="" disabled selected hidden>choose a City</option>  
      @foreach($cities as $city) 
      <option value="{{$city->id}}">{{$city->name}}</option>
      @endforeach
    </select>
  </div>

  {{-- <div class="mb-3 col-sm-6" id="gymDiv">
    <label for="gym" class="form-label">Gyms</label>
    <select name="gym" class="form-control" id="gym">      
    </select>
  </div>
   --}}
  {{-- <div class="mb-3 col-sm-6">
    <label for="ban" class="form-label">IsBaned</label>
    <select name="ban" class="form-control" id="ban">
        <option value="not_baned">0</option>
        <option value="is_baned">1</option>
</select>
  </div> --}}
  <button type="submit" class="btn btn-success">Create</button>
</form>  
</div>

<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {
              
     

        
    
});
    // Interactive Upload Image
    let avatarInput = document.querySelector("input[name='avatar']");
    let avatarImg = document.querySelector('.profile-user-img');
    avatarInput.addEventListener('change', () => previewImage(avatarImg))
</script>


@endsection 
