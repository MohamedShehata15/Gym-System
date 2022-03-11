@extends('layouts.app')

{{-- @php
    if(Auth::user()->hasRole('coach'))
        $coach = Auth::user();
@endphp --}}

@section('content')
<div class=" mydiv">
<form class="row d-flex flex-column justify-content-center align-items-center" >
    <h2 class="text-center"><span>Change Password</span></h2>
    <div class="form-group mb-3  col-sm-6">
        <label for="inputCurrnetPassword">Current Passwrd</label>
        <input type="password" class="form-control" id="inputCurrnetPassword" placeholder="Currnet Passwrod">
    </div>
    <div class="form-group mb-3  col-sm-6">
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
    </div>
    <div class="form-group mb-3  col-sm-6">
        <label for="inputConfirmPassword">Confirm Password</label>
        <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
    </div>

    <button type="submit" class="btn btn-primary">Update Passwrd</button>
</form>
</div>
@endsection
