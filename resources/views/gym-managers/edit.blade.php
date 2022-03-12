@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class=" mydiv">

    <form method="post" action="{{route('gym-managers.update',$staff->id)}}"
        class="row d-flex flex-column justify-content-center align-items-center" enctype="multipart/form-data">

        @csrf
        @method('PUT')
        <div class="text-center">
            <label for="avatar" class="form-label" role="button">
                <img class="profile-user-img img-fluid img-circle" src="{{asset('images/'. $staff->avatar . '')}}"
                    alt="User profile picture">
            </label>
            <input type="file" name="avatar" id="avatar" class="d-none" value="{{$staff->avatar}}"
                accept="image/x-png,image/gif,image/jpeg" />
        </div>


        <input type="hidden" name="id" value="{{ $staff->id }}">
        <div class="mb-3 col-sm-6">
            <label for="Name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
                value="{{$staff->name}}" />
        </div>
        <div class="mb-3 col-sm-6">
            <label for="Email" class="form-label">Email</label>
            <input type="email" name="email" id="Email" class="form-control" value="{{$staff->email}}" />
        </div>
        <div class="mb-3 col-sm-6">
            <label for="pass" class="form-label">Old Password</label>
            <input type="password" name="oldpassword" id="password" class="form-control" value="" />
        </div>
        <div class="mb-3 col-sm-6">
            <label for="confirm" class="form-label">New Password</label>
            <input type="password" name="password" id="confirm" class="form-control" value="" />
        </div>
        <div class="mb-3 col-sm-6">
            <label for="confirm" class="form-label">Confrim New Password</label>
            <input type="password" name="confirm" id="confirm" class="form-control" value="" />
        </div>
        <div class="mb-3 col-sm-6">
            <label for="national_id" class="form-label">National_id</label>
            <input type="text" name="national_id" id="national_id" class="form-control"
                value="{{$staff->national_id}}" />
        </div>


        <div class="mb-3 col-sm-6" id="cityDiv">
            <label for="city" class="form-label">City</label>
            <select name="city" class="form-control" id="city">
                @role('Super-Admin')
                <option value="" disabled selected hidden>choose a City</option>
                @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
                @endrole

                @role('city_manager')
                <option value="{{Auth::user()->city->id}}">{{Auth::user()->city->name}}</option>
                @endrole
            </select>
        </div>

        <div class="mb-3 col-sm-6" id="gymDiv">
            <label for="gym" class="form-label">Gyms</label>
            <select name="gym" class="form-control" id="gym">
              <option value="" disabled selected hidden>choose a Gym</option>
            </select>
        </div>

        {{-- <div class="mb-3 col-sm-6">
    <label for="ban" class="form-label">IsBaned</label>
    <select name="ban" class="form-control" id="ban">
        <option value="0">No</option>
        <option value="1">Yes</option>
</select>
  </div> --}}
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {

        $("#city").change(function () {
            var cityID = $(this).val();
            getGyms(cityId)
        });

        @role('city_manager')
        let cityId = {{Auth::user()->city->id}}
        getGyms(cityId)
        @endrole

        function getGyms(cityID) {
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
                                $('select[name="gym"]').append('<option value="' +
                                    gym.id + '">' + gym.name + '</option>');
                            });
                        } else {
                            $('#gym').empty();
                        }
                    }
                });
            } else {
                $('#gym').empty();
            }
        }

    });

    // Interactive Upload Image
    let avatarInput = document.querySelector("input[name='avatar']");
    let avatarImg = document.querySelector('.profile-user-img');
    avatarInput.addEventListener('change', () => previewImage(avatarImg))

</script>


@endsection
