@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection
@section('content')
<div class="selectDiv">
<select class=" selectBody form-select " >
    <option selected disabled hidden> Select User </option>
    @foreach($users as $user)
    <option value={{$user->id}}>{{$user->name}}</option>
    @endforeach
</select>
<select class="selectBody form-select " >
    <option selected disabled hidden> Select Training Package </option>
    @foreach($packages as $package)
    <option value={{$package->id}}>{{$package->name}}</option>
    @endforeach
</select>
</div>
@endsection
@section('third_party_scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@endsection