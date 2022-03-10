@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('content')
<div class="revDiv card bg-dark ">
    <div class="revBody">
          Revenue :: {{$revenue}}
    </div>
</div>
@endsection