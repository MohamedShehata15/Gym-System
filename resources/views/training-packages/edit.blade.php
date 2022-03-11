@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('content')
<div class=" mydiv">

<form method="post" action="{{route('training-packages.update',$trainingPackage->id)}}" class="row d-flex flex-column justify-content-center align-items-center" >
  @csrf
  @method('put')
  <div class="mb-3 col-sm-6">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" name="Name" aria-describedby="emailHelp" value="{{$trainingPackage['name']}}"/>
  </div>
  <div class="mb-3 col-sm-6">
    <label for="Price" class="form-label">Price</label>
    <input type="text" name="Price" id="Price" class="form-control" value="{{$trainingPackage['price']*0.01}}"/>
  </div>
  <div class="mb-3 col-sm-6">
    <label for="sessionNum" class="form-label">Session Number</label>
    <input type="text" name="sessionNum" id="sessionNum" class="form-control" value="{{$trainingPackage['session_number']}}"/>
  </div>
  <div class="mb-3 col-sm-6">
    <label for="gym" class="form-label">Gym Name</label>
    <select name="gym" class="form-control" id="gym">
      @foreach ($gyms as $gym)
      <option value="{{$gym->id}}" {{$gym->id == $trainingPackage->gym_id ? "selected" : ""}}>{{$gym->name}}</option>   
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</form>   
</div>
@endsection