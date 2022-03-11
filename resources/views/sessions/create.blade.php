@extends('layouts.app')

@section('title') Create @endsection

@section('styles')
<link href=”https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css” rel=”stylesheet”>

@endsection


@section('content')  
<div class="coachesSession">
        <form  method="POST"  action="{{route('sessions.store')}}" class="row d-flex flex-column justify-content-center align-items-center" >

            @csrf
            <div class="mb-3 col-sm-6 ">
              <label for="exampleInputEmail1" class="form-label">Name</label>
              <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Session Name">
            </div>

        <div class="mb-3 col-sm-6">
            <label for="Day">Day</label>
            <input name="day" id="Day" class="form-control" type="date" />
        </div>

        <div class="mb-3 col-sm-6">
        <label for="start">Start-time</label>
        <input name="start" type="time" class="form-control" />
        </div>     

        <div class="mb-3 col-sm-6">
        <label for="finish">finish-time</label>
        <input name="finish" type="time" class="form-control" />
        </div>      
        
        <div class="mb-3 col-sm-6">
          <label for="inputCity" class="form-label">City</label>
          <select id="inputCity" class="form-select form-control cities" aria-label="Default select" name="city">
              @if(Auth::user()->hasRole('Super-Admin'))
              <option selected disabled>Select a City</option>
              @foreach($cities as $city)
              <option value="{{$city->id}}">{{$city->name}}</option>
              @endforeach
              @elseif(Auth::user()->hasRole('city_manager'))
              <option value="{{Auth::user()->city->id}}">{{Auth::user()->city->name}}</option>
              @elseif(Auth::user()->hasRole('gym_manager'))
              @php
                  $city = Auth::user()->gymManger->first()->city;
              @endphp
              <option value={{$city->id}}>{{$city->name}}</option>
              @endif
          </select>
      </div>
      
      <div class="mb-3 col-sm-6">
          <label for="inputGym" class="form-label">Gym</label>
          <select id="inputGym" class="form-select form-control gyms" aria-label="Default select" name="gym">

              @if(Auth::user()->hasRole('city_manager') || Auth::user()->hasRole('Super-Admin'))
              <option selected disabled>Select a Gym</option>
              @endif

              @if(Auth::user()->hasRole('city_manager'))
              @foreach (Auth::user()->city->gyms as $gym)
              <option value="{{$gym->id}}">{{$gym->name}}</option>
              @endforeach
              @elseif(Auth::user()->hasRole('gym_manager'))
                  @php
                  $gym = Auth::user()->gymManger->first();
                  @endphp
                  <option id={{$gym->id}}>{{$gym->name}}</option>
              @endif
          </select>
      </div>
   

        <div class="form-group col-sm-6">
        <label for="exampleFormControlSelect2">Choose Coaches</label>
       <select name="coaches[]" class="form-control coachesSelect" id="coaches">
       @role('gym_manager')
       @php
       $coaches = Auth::user()->gymManger->first()->gymCoaches;
       @endphp
                <option value="" disabled selected hidden>Select a Coach</option>
                @foreach($coaches as $coach)
                  {
                    <option value={{$coach->id}}>{{$coach->name}}</option>
                  }
                  @endforeach
        @endrole
       </select>
      </div>
      <div class="coachesTags my-3 d-flex flex-wrap"></div>
                <div class="mb-3 col-sm-6 offset-5">
            <button type="submit" class="btn btn-success btn-lg ">Add</button>
            </div>
          </form>         
          </div>
@endsection

@section('script')
<script type="text/javascript">
  $(function () {

      @if(Auth::user() -> hasRole('Super-Admin'))
      // Handle City
      $('.cities').on('change', function () {
          $.ajax({
              type: 'get',
              headers: {
                  'Accept': 'application/json'
              },
              url: `http://127.0.0.1:8000/cities/${$(this).val()}/gyms`,
              success: function (response) {
                  $('.gyms').empty();
                  $('#coaches').empty();
                  $('.gyms').append(`<option value="" disabled selected hidden>Select a Gym</option>`);
                  if(response.gyms.length > 0) {
                      response.gyms.forEach(gym => {
                          $('.gyms').append(
                              `<option value="${gym.id}">${gym.name}</option>`);
                      })
                  }
              }
          })
      });
      @endif

      @if(Auth::user()->hasRole('Super-Admin') || Auth::user()->hasRole('city_manager'))
      $('.gyms').on('change', function () {
          $.ajax({
              type: 'get',
              headers: {
                  'Accept': 'application/json'
              },
              url: `http://127.0.0.1:8000/gyms/${$(this).val()}/coaches`,
              success: function (response) {
                  $('#coaches').empty();
                  $('#coaches').append(`<option value="" disabled selected hidden>Select a Coach</option>`);
                  response.coaches.forEach(coach => {

                      $('#coaches').append(`<option value="${coach.id}">
                          <span>${coach.name}</span>
                      </option>`);
                  })
              }
          })
      });
      @endif

      // Gyms Tags
      document.querySelector('.coachesSession .coachesSelect').addEventListener('input', e => tags(e, ".coachesTags"));

    // Submit the Data with Data of tags
    document.querySelector('.coachesSession').addEventListener('submit', (e) => {
        generateInputSaveTagsID(e, '.coachesSession .coachesTags', 'coaches');
    })

  });
    </script>
@endsection
