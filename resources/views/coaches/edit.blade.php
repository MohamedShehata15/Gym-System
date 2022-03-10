@extends('layouts.app')

{{-- @section('content')
<form>
<div class="text-center">
    <img class="profile-user-img img-fluid img-circle" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="User profile picture">
</div>
    <div class="form-group">
        <label for="inputName">Name</label>
        <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{$coach->name}}">
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{$coach->email}}">
</div>

<div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
</div>
<div class="form-group">
    <label for="inputConfirmPassword">Confirm Password</label>
    <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
</div>


<button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection --}}

@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<form method="post" action="{{route('coaches.update',$coach->id)}}" class="pt-5">
    <div class="text-center">
        <label for="avatar" class="form-label" role="button">
            <img class="profile-user-img img-fluid img-circle" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="User profile picture">
        </label>
        <input type="file" name="avatar" id="avatar" class="d-none" value="{{$coach->avatar}}" />
    </div>
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="Name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
            value="{{$coach->name}}" />
    </div>
    <div class="mb-3">
        <label for="Email" class="form-label">Email</label>
        <input type="email" name="email" id="Email" class="form-control" value="{{$coach->email}}" />
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control"  placeholder="Type your password if youw wanna change it"/>
    </div>
    <div class="mb-3">
        <label for="confirm" class="form-label">Confrim Password</label>
        <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Conirm your password if you wanna change it" />
    </div>

    <div class="mb-3 ">
        <label for="national_id" class="form-label">National_id</label>
        <input type="text" name="national_id" id="national_id" class="form-control" value="{{$coach->national_id}}" />
    </div>


    <div class="mb-3" id="cityDiv">
        <label for="city" class="form-label">City</label>
        <select name="city" class="form-control" id="city">
            <option value="" disabled selected hidden>choose a City</option>
            {{-- @foreach($cities as $city)
            <option value="{{$city->id}}" {{$city->id == $gymsCity->id ? "selected" : ""}}>{{$city->name}}</option>
            @endforeach --}}
        </select>
    </div>

    <div class="mb-3" id="gymDiv">
        <label for="gym[]" class="form-label">Gyms</label>
        <select name="gyms[]" class="form-control" multiple id="gym">
            {{-- @foreach($gymsCollection as $gym)
            <option value="{{$gym->id}}">{{$gym->name}}</option>
            @endforeach --}}
        </select>
    </div>

    {{-- <div class="mb-3">
    <label for="ban" class="form-label">IsBaned</label>
    <select name="ban" class="form-control" id="ban">
        <option value="0">No</option>
        <option value="1">Yes</option>
</select>
  </div> --}}
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {

        $("#city").change(function () {
            var cityID = $(this).val();

            if (cityID) {
                $.ajax({
                    url: '/getGym/' + cityID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $('#gym').empty();
                            $('#gym').append('<option hidden>Choose a Gym</option>');
                            $.each(data, function (key, gym) {

                                $('select[name="gyms[]"]').append(
                                    '<option value="' + gym.id + '">' + gym
                                    .name + '</option>');

                            });
                        } else {
                            $('#gym').empty();
                        }
                    }
                });
            } else {
                $('#gym').empty();
            }
        });

    });

</script>


@endsection
