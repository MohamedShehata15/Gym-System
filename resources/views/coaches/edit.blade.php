@php
    $coachGyms = $coach->coachGyms->pluck('id')->all();
@endphp


@extends('layouts.app')

@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<form class="editCoach" method="post" action="{{route('coaches.update',$coach->id)}}" class="pt-5">
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

    <div class="mb-3 ">
        <label for="national_id" class="form-label">National_id</label>
        <input type="text" name="national_id" id="national_id" class="form-control" value="{{$coach->national_id}}" />
    </div>


    <div class="mb-3" id="cityDiv">
        <label for="city" class="form-label">City</label>
        <select name="city" class="form-control" id="city">
            <option value="" disabled selected>choose a City</option>
            @foreach($cities as $city)
            <option value="{{$city->id}}">{{$city->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3" id="gymDiv">
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

    <button type="submit" class="btn btn-primary">Update</button>
</form>
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

                    let selectedGyms = getSelectedGyms();


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

    // Get Selected Gyms
    function getSelectedGyms() {
        let selectedGyms = [];
    let tags = document.querySelectorAll('.tag');
                for(let tag of tags) {
                    selectedGyms.push(+tag.dataset.tag);
                }
                return selectedGyms;
    }

    document.querySelector('.editCoach').addEventListener('submit', (e) => {
        let selectedGyms = getSelectedGyms();
        selectedGyms.forEach(gym => {
            let inputGymId = document.createElement('input');
            inputGymId.setAttribute('type', 'hidden');
            inputGymId.setAttribute('name', 'gyms[]');
            inputGymId.setAttribute('value', gym);
            e.target.append(inputGymId);
        })
    })


    // Gyms Tags
    document.querySelector('#gymDiv #gym').addEventListener('input', e => tags(e, ".gymsTags"));
    function handleSelectedTag(element, optionClass) {
        document.querySelector(`.${optionClass}`)?.classList.remove('d-none');
       element.parentElement.remove();
    }

    function tags(e, tagsContainer) {
        let option = e.target.options[e.target.selectedIndex];
            let parentSpan = document.createElement('span');
            let spanTag = document.createElement('span');
            let textTag = document.createTextNode(option.text + ' ');
            let deleteTag = document.createElement('span');
            let deleteText = document.createTextNode(' X');
            deleteTag.classList.add()
            deleteTag.addEventListener('click', function() {
                this.parentElement.remove();
                option.classList.remove('d-none');
            });
            parentSpan.classList.add('bg-dark', 'text-white', 'px-3', 'py-2', 'rounded-pill', 'mt-2', 'mr-2');
            deleteTag.classList.add('text-danger');
            deleteTag.setAttribute('role', 'button');
            spanTag.append(textTag);
            deleteTag.append(deleteText);

            parentSpan.append(spanTag)
            parentSpan.append(deleteTag);
            document.querySelector(tagsContainer).append(parentSpan);

            option.classList.add('d-none');

            e.target.options[0].selected=true
    }

</script>


@endsection
