@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@if(Auth::user()->role == 'admin')
<br><br>
<table id="table_id" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>national_id</th>
            <th>avatar</th>
            <th>is_baned</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endif

@if(Auth::user()->role == 'coach')
<div class="card-body text-center">
    <div class="text-center mb-2">
        <img class="profile-user-img img-fluid img-circle"
            src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="User profile picture">
    </div>
    <p class="mb-4">{{$name}}</p>
    <a class="btn btn-app" href="{{route('coaches.profile')}}">
        <i class="fas fa-user"></i> Profile
    </a>
    <a class="btn btn-app" href="{{route('coaches.edit')}}">
        <i class="fas fa-edit"></i> Edit Profile
    </a>
    <a class="btn btn-app" href="{{route('coaches.password')}}">
        <i class="fas fa-lock"></i> Change Password
    </a>
    <a class="btn btn-app" href="{{route('coaches.sessions')}}">
        <i class="fas fa-calendar-check"></i> Sessions
    </a>
</div>

@endif

@endsection
@section('third_party_scripts')
<script src="{{ mix('js/app.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js" defer>
</script>
<script>
    $(document).ready(function () {
<br>
<div class="d-flex justify-content-center mb-2">
    <a href="{{route('coaches.create')}}" class="btn btn-success">Add New Coach </a>
  </div>


    <table id="table_id" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>National_ID</th>
                <th>Is_Baned</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
@section('third_party_scripts')
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js" defer></script>
    <script>
        $(document).ready( function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('coaches.index') }}"
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data:'avatar',
                    name:'avatar',
                    render:function(data,type,full,meta)
                    {
                        return "<img src="+data+" width='70' class='img-thumbnail' />";
                    },
                    orderable: false
                },
                {
                    data:'national_id',
                    name:'national_id',
                },
                {
                    data:"is_baned",
                    name:"is_baned",
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });
    } );
    function deleteFunc(id){
        if (confirm("Delete Record?") == true) {
        var id = id;
         // ajax
        $.ajax({
           type:"POST",
           url: "{{ url('destroy-coach') }}",
           data: { id: id },
           dataType: 'json',
           success: function(res){
            $('#table_id').DataTable().ajax.reload();
              },
            error:function(){ 
            alert("Failed");
        }
         });
         
    }}
    </script>
@endsection
