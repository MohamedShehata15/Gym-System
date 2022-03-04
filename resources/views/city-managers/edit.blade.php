@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('content')
<form method="post" action="{{route('staff.update',$staff->id)}}" class="mt-5">
  @csrf
  @method('put')
  <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" name="Name" aria-describedby="emailHelp" value="{{$staff['name']}}"/>
  </div>
  <div class="mb-3">
    <label for="Email" class="form-label">Email</label>
    <input type="email" name="Email" id="Email" class="form-control" value="{{$staff['email']}}"/>
  </div>
  <div class="mb-3">
    <label for="pass" class="form-label">Password</label>
    <input type="password" name="pass" id="pass" class="form-control" value="{{$staff['password']}}"/>
  </div>
  <div class="mb-3">
    <label for="confirm" class="form-label">Confrim Password</label>
    <input type="password" name="confirm" id="confirm" class="form-control" value="{{$staff['password']}}"/>
  </div>
  <div class="mb-3">
    <label for="avatar" class="form-label">Avatar</label>
    <input type="file" name="avatar" id="avatar" class="form-control" value="{{$staff['avatar']}}"/>
  </div>
  <div class="mb-3 ">
    <label for="national_id" class="form-label">National_id</label>
    <input type="text" name="national_id" id="national_id" class="form-control" value="{{$staff['national_id']}}"/>
  </div>
  <div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <input type="text" name="role" id="role" class="form-control" value="{{$staff['role']}}"/>
  </div>
  <div class="mb-3">
    <label for="bane" class="form-label">IsBaned</label>
    <input type="text" name="bane" id="bane" class="form-control" value="{{$staff['is_baned']}}"/>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>   
@endsection