@extends('layouts.app')

@section('content')
<div class="selectDiv mydiv">
@role('Super-Admin')
<form class="row d-flex flex-column justify-content-center align-items-center" >
<div class="mb-3 col-sm-6" id="cityDiv">
 <label for="city" class="form-label">City</label>
  <select class="form-control" id="city" >
    <option selected disabled hidden> Select City </option>
    @foreach($cities as $city)
    <option value={{$city->id}}>{{$city->name}}</option>
    @endforeach
</select>
</div>
@endrole

@can('gym-managers')
<div class="mb-3 col-sm-6" id="gymDiv">
 <label for="gym" class="form-label">Gym</label>
<select class="form-control" id="gym" >
    <option selected disabled hidden> Select Gym </option>
    @foreach($gyms as $gym)
    <option value={{$gym->id}}>{{$gym->name}}</option>
    @endforeach
</select>
</div>
@endcan

<div class="mb-3 col-sm-6" id="userDiv">
<label for="user" class="form-label">User</label>
<select class="form-control" id="user" >
    <option selected disabled hidden> Select User </option>
    @role('gym_manager')
    @foreach($users as $user)
    <option value={{$user->id}}>{{$user->name}}</option>
    @endforeach
    @endrole
</select>
</div>

<div class="mb-3 col-sm-6" id="packageDiv">
<label for="package" class="form-label">Package</label>
<select class="form-control " id="package">
    <option selected disabled hidden> Select Training Package </option>
    @role('gym_manager')
    @foreach($packages as $package)
    <option value={{$package->id}}>{{$package->name}}</option>
    @endforeach
    @endrole
</select>
</div>

<button type="submit" class="btn btn-success">Buy</button>

</form>
</div>
@endsection
@section('third_party_scripts')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
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
                                $('select[id="gym"]').append('<option value="'+ gym.id +'">' + gym.name+ '</option>');
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
    $("#gym").change(function(){
            var gymId = $(this).val();
           
               if(gymId) {
                   $.ajax({
                       url: '/getUser/'+gymId,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#user').empty();
                            $('#user').append('<option selected disabled hidden>Select User</option>');
                            $.each(data, function(key, user){
                                $('select[id="user"]').append('<option value="'+ user.id +'">' + user.name+ '</option>');
                            });
                            $('#package').empty();
                            $('#package').append('<option selected disabled hidden>Select Training Package</option>');
                            $.each(data, function(key, package){
                                $('select[id="package"]').append('<option value="'+ package.id +'">' + package.name+ '</option>');
                            });
                        }else{
                            $('#user').empty();
                        }
                     }
                   });
               }else{
                 $('#user').empty();
               }
          });
    $("#gym").change(function(){
            var gymId = $(this).val();
           
               if(gymId) {
                   $.ajax({
                       url: '/getPackage/'+gymId,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#package').empty();
                            $('#package').append('<option selected disabled hidden>Select Training Package</option>');
                            $.each(data, function(key, package){
                                $('select[id="package"]').append('<option value="'+ package.id +'">' + package.name+ '</option>');
                            });
                        }else{
                            $('#package').empty();
                        }
                     }
                   });
               }else{
                 $('#package').empty();
               }
          });
});
</script>

@endsection