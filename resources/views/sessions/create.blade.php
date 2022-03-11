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
              <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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

        <div class="form-group col-sm-6">
        <label for="exampleFormControlSelect2">Choose Coaches</label>
       <select class="form-control coachesSelect" id="exampleFormControlSelect2">
       coaches
       @foreach($coaches as $coach)
                  {
                    <option value={{$coach->id}}>{{$coach->name}}</option>
                  }
                  @endforeach
       </select>
      </div>
      <div class="coachesTags my-3 d-flex flex-wrap"></div>
                <div class="mb-3 col-sm-6 offset-5">
            <button type="submit" class="btn btn-success btn-lg ">Add</button>
            </div>
          </form>         
          </div>
@endsection

@section('javascripts')
<script>
      // Gyms Tags
      document.querySelector('.coachesSession .coachesSelect').addEventListener('input', e => tags(e, ".coachesTags"));

    // Submit the Data with Data of tags
    document.querySelector('.coachesSession').addEventListener('submit', (e) => {
        generateInputSaveTagsID(e, '.coachesSession .coachesTags', 'coaches');
    })
</script>
@endsection
