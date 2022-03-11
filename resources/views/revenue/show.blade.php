@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('content')
<div class=" d-flex justify-content-center mydiv">
    <div class="card p-5 bg-success">
        <div class="pricing  rounded  d-flex ">
                <i class="nav-icon fas fa  fa-credit-card"></i> 
                <div class="d-flex flex-column ml-4"> <span class="business">Revenue : ${{$revenue * 0.01}}</span> </div>
                </div>

        </div>
        </div>
</div>
<!-- <h3> Revenue :: {{$revenue}}</h3> -->

@endsection