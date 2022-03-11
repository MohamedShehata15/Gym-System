@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('content')
<div class="mydiv">
<form method="post" action="{{route('users.update',$user->id)}}" class="row d-flex flex-column justify-content-center align-items-center" enctype="multipart/form-data" >
  @csrf
  @method('put')
  <div class="mb-3 col-sm-6">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" name="Name" aria-describedby="emailHelp" value="{{$user['name']}}"/>
  </div>
  <div class="mb-3 col-sm-6">
    <label for="Email" class="form-label">Email</label>
    <input type="email" name="Email" id="Email" class="form-control" value="{{$user['email']}}"/>
  </div>
  <div class="mb-3 col-sm-6">
    <label for="Gender" class="form-label">Gender</label><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="Gender" id="Female" value="Female" {{$user['gender'] == "Female" ? "checked" : ""}}>
        <label class="form-check-label" for="Female">Female</label>
    </div>
    <div class="form-check form-check-inline mb-3 col-sm-6">
        <input class="form-check-input" type="radio" name="Gender" id="Male" value="Male" {{$user['gender'] == "Male" ? "checked" : ""}}>
        <label class="form-check-label" for="Male">Male</label>
    </div>
    <div class="mb-3 col-sm-12" >
        <label for="avatar" class="form-label mt-1">Avatar</label>
        <input type="file" name="avatar" id="avatar" class="form-control" accept=" .png, .jpeg" value="{{$user['avatar']}}"/>
      </div>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</form>   
</div>
@endsection