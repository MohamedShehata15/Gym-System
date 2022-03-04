@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('content')
<form method="post" action="{{route('training-packages.update',$training_package->id)}}" class="mt-5">
  @csrf
  @method('put')
  <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" name="Name" aria-describedby="emailHelp" value="{{$training_package['name']}}"/>
  </div>
  <div class="mb-3">
    <label for="Email" class="form-label">Price</label>
    <input type="email" name="Email" id="Email" class="form-control" value="{{$training_package['price']}}"/>
  </div>
  <div class="mb-3">
    <label for="pass" class="form-label">Session Number</label>
    <input type="password" name="pass" id="pass" class="form-control" value="{{$training_package['session_number']}}"/>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>   
@endsection