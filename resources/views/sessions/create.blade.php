@extends('layouts.app')

@section('title') Create @endsection

@section('content')

  
        <form  method="POST" action="#" class="mt-5 ">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Name</label>
              <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        <div class="mb-3">
            <label for="Day">Day</label>
            <input id="Day" class="form-control" type="date" />
        </div>

        <div class="mb-3">
        <label for="start">Start-time</label>
        <input type="time" class="form-control" />
        </div>     

        <div class="mb-3">
        <label for="finish">finish-time</label>
        <input type="time" class="form-control" />
        </div>        

        <div class="form-group">
        <label for="exampleFormControlSelect2">Choose Coaches</label>
       <select multiple class="form-control" id="exampleFormControlSelect2">
        <option>captin1</option>
        <option>captin2</option>
        <option>captin3</option>
        <option>captin4</option>
        <option>captin5</option>
       </select>
      </div>
                
            <button type="submit" class="btn btn-success">Submit</button>

          </form>

@endsection