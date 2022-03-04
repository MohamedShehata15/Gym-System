@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('content')
<form method="post" action="{{route('staff.store')}}" class="mt-5">
  @csrf
  <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" name="Name" aria-describedby="emailHelp" />
  </div>
  <div class="mb-3">
    <label for="Email" class="form-label">Email</label>
    <input type="email" name="Email" id="Email" class="form-control" />
  </div>
  <div class="mb-3">
    <label for="pass" class="form-label">Password</label>
    <input type="password" name="pass" id="pass" class="form-control" />
  </div>
  <div class="mb-3">
    <label for="confirm" class="form-label">Confrim Password</label>
    <input type="password" name="confirm" id="confirm" class="form-control" />
  </div>
  <div class="mb-3">
    <label for="avatar" class="form-label">Avatar</label>
    <input type="file" name="avatar" id="avatar" class="form-control" />
  </div>
  <div class="mb-3 ">
    <label for="national_id" class="form-label">National_id</label>
    <input type="text" name="national_id" id="national_id" class="form-control" />
  </div>
  <div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select name="role" class="form-control" id="">
            <option value="" disabled selected hidden>choose role of member</option>
            <option value="gym_manager">Gym Manager</option>
            <option value="city_manager">City Manager</option>
            <option value="coach">Coach</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="bane" class="form-label">IsBaned</label>
    <select name="role" class="form-control" id="">
        <option value="not_baned">0</option>
        <option value="is_baned">1</option>
</select>
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>   
@endsection 
