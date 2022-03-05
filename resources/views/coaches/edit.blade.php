@extends('layouts.app')

@section('content')
<form>
<div class="text-center">
    <img class="profile-user-img img-fluid img-circle" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="User profile picture">
</div>
    <div class="form-group">
        <label for="inputName">Name</label>
        <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{$coach->name}}">
    </div>
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{$coach->email}}">
    </div>

    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="inputConfirmPassword">Confirm Password</label>
        <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
    </div>


    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
