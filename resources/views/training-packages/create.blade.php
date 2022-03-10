@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class=" mydiv">
<form method="post" action="{{route('training-packages.store')}}" class="row d-flex flex-column justify-content-center align-items-center">
  @csrf
  <div class="mb-3 col-sm-6">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" name="Name" aria-describedby="emailHelp" placeholder="enter Training Package Name"/>
  </div>
  <div class="mb-3 col-sm-6">
    <label for="Price" class="form-label">Price</label>
    <input type="text" name="Price" id="Price" class="form-control" placeholder="enter Training Package Price in Dollar"/>
  </div>
  <div class="mb-3 col-sm-6">
    <label for="sessionNum" class="form-label">Session Number</label>
    <input type="text" name="sessionNum" id="sessionNum" class="form-control" placeholder="enter Session Number"/>
  </div>
  <div class="mb-3 col-sm-6" id="gymDiv">
    <label for="gym" class="form-label">Gym</label>
    <select name="gym" class="form-control" id="gym">
      <option value="" disabled selected hidden>choose a Gym</option>  
      @foreach($gyms as $gym) 
      <option value="{{$gym->id}}">{{$gym->name}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-success btn-lg">Create</button>
</form>
</div>
@endsection 
