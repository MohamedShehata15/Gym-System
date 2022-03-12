@php
    $coachGyms = $coach->coachGyms->pluck('id')->all();
@endphp


@extends('layouts.app')

@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class=" mydiv">

<form method="post" action="{{route('coaches.update',$coach->id)}}" class="row d-flex flex-column justify-content-center align-items-center editCoach" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="text-center">
        <label for="avatar" class="form-label" role="button">
            <img class="profile-user-img img-fluid img-circle" src="{{asset('images/'. $coach->avatar . '')}}" alt="User profile picture">
        </label>
        <input type="file" name="avatar" id="avatar" class="d-none" value="{{$coach->avatar}}" accept="image/x-png,image/gif,image/jpeg"/>
    </div>
   
    <div class="mb-3  col-sm-6">
        <label for="Name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"
            value="{{$coach->name}}" />
    </div>
    <div class="mb-3  col-sm-6">
        <label for="Email" class="form-label">Email</label>
        <input type="email" name="email" id="Email" class="form-control" value="{{$coach->email}}" />
    </div>

    <div class="mb-3  col-sm-6">
        <label for="national_id" class="form-label">National_id</label>
        <input type="text" name="national_id" id="national_id" class="form-control" value="{{$coach->national_id}}" />
    </div>

    @role('Super-Admin')
    <div class="mb-3  col-sm-6" id="cityDiv">
        <label for="city" class="form-label">City</label>
        <select name="city" class="form-control" id="city">
            <option value="" disabled selected>choose a City</option>
            @foreach($cities as $city)
            <option value="{{$city->id}}">{{$city->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-sm-6" id="gymDiv">
        <label for="gym" class="form-label">Gyms</label>
        <select name="gyms" class="form-control" id="gym">
            <option value="" disabled selected>choose a Gym</option>
        </select>
        <div class="gymsTags mt-3 d-flex flex-wrap">

            @php
            foreach($coach->coachGyms as $coach) {
                $optionClass = $coach->name . "_" . $coach->id;
             echo "<span data-tag={$coach->id} class='tag bg-dark text-white px-3 py-2 rounded-pill mt-2 mr-2'><span>{$coach->name} </span><span class='text-danger' role='button' onclick='handleSelectedTag(this, `$optionClass`)'> X</span></span>";
            }
            @endphp

        </div>
    </div>

    @endrole

    <button type="submit" class="btn btn-primary col-sm-6">Update</button>
</form>
</div>

@role('Super-Admin')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<script>

    $(document).ready(function () {

        $('#cityDiv #city').on('change', function (e) {
            $.ajax({
                type: 'get',
                headers: {
                    'Accept': 'application/json'
                },
                url: `http://127.0.0.1:8000/cities/${$(this).val()}/gyms`,
                success: function (response) {
                    $('#gymDiv #gym').html(`<option value="" disabled selected>choose a Gym</option>`);

                    let selectedGyms = getSelectedGyms('.editCoach .gymsTags .tag');


                    if(response.gyms.length > 0) {
                        response.gyms.forEach(gym => {
                            let hiddenClass = "";
                            if(selectedGyms.includes(gym.id))
                                hiddenClass=`d-none ${gym.name}_${gym.id}`;
                            $('#gymDiv #gym').append(
                                `<option class="tag ${hiddenClass}" value="${gym.id}">${gym.name}</option>`);
                        })
                    }
                }
            })
        });

    });

    // Submit the Data
    document.querySelector('.editCoach').addEventListener('submit', (e) => {
        generateInputSaveTagsID(e, '.editCoach .gymsTags', 'gyms');
    })


    // Gyms Tags
    document.querySelector('#gymDiv #gym').addEventListener('input', e => tags(e, ".gymsTags"));

    // Interactive Upload Image
    let avatarInput = document.querySelector("input[name='avatar']");
    let avatarImg = document.querySelector('.profile-user-img');
    avatarInput.addEventListener('change', () => previewImage(avatarImg))

</script>
@endrole

@endsection
