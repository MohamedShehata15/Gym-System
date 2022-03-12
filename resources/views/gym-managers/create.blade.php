@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="mydiv ">

<form method="post" action="{{route('gym-managers.store')}}" class="row d-flex flex-column justify-content-center align-items-center"  id="form" enctype="multipart/form-data">
  @csrf

  <div class="text-center">
    <label for="avatar" class="form-label" role="button">
        <img class="profile-user-img img-fluid img-circle" src="{{asset('images/user_avatar.png')}}" alt="User profile picture">
    </label>
    <input type="file" name="avatar" id="avatar" class="d-none" accept="image/x-png,image/gif,image/jpeg" />
  </div>

  <div class="mb-3 col-sm-6 ">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" />
  </div>
  <div class="mb-3 col-sm-6">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control" />
  </div>
  <div class="mb-3 col-sm-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control" />
  </div>
  <div class="mb-3 col-sm-6">
    <label for="confirm" class="form-label">Confrim Password</label>
    <input type="password" name="confirm" id="confirm" class="form-control" />
  </div>
 
  <div class="mb-3 col-sm-6 ">
    <label for="national_id" class="form-label">National_id</label>
    <input type="text" name="national_id" id="national_id" class="form-control" />
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

  <div class="mb-3 col-sm-6" id="gymDiv">
    <label for="gym" class="form-label">Gyms</label>
    <select name="gym" class="form-control" id="gym">      

    </select>
  </div>
  <div class="mb-3 col-sm-6 offset-2">
  <button type="submit" class="btn btn-success offset-3">Create</button>
  </div>
</form>  
</div>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {
    
      
    $("#city").change(function(){
            var cityID = $(this).val();
           
               if(cityID) {
                   $.ajax({
                       url: '/getGym/'+cityID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#gym').empty();
                            $('#gym').append('<option hidden>Choose a Gym</option>');
                            $.each(data, function(key, gym){
                                $('select[name="gym"]').append('<option value="'+ gym.id +'">' + gym.name+ '</option>');
                            });
                        }else{
                            $('#gym').empty();
                        }
                     }
                   });
               }else{
                 $('#gym').empty();
               }
          });

});
</script>


@endsection 
