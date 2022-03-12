@extends('layouts.app')

{{-- @php
    if(Auth::user()->hasRole('coach'))
        $coach = Auth::user();
@endphp --}}

@section('content')
    

<div class=" mydiv">
<form method="POST"  action="{{route('coaches.passwordUpdate',$coachId)}}"  class="row d-flex flex-column justify-content-center align-items-center" >
    @csrf
    @method('PUT')
    <h2 class="text-center"><span>Change Password</span></h2>
    <div class="form-group mb-3  col-sm-6">
        <label for="inputCurrnetPassword">Current Passwrd</label>
        <input type="password" name="oldpassword" id="oldpassword" class="form-control" value=""/>
    </div>
    <div class="form-group mb-3  col-sm-6">
        <label for="inputPassword">Password</label>
        <input type="password" name="password" id="password" class="form-control" value=""/>
    </div>
    <div class="form-group mb-3  col-sm-6">
        <label for="inputConfirmPassword">Confirm Password</label>
        <input type="password" name="confirm" id="confirm" class="form-control" value=""/>
    </div>
    <button type="submit" class="btn btn-primary">Update Passwrd</button>
</form>
</div>
@endsection
