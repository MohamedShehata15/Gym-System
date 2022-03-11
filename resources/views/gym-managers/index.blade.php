@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="text-center mydiv">
    <a href="{{route('gym-managers.create')}}" class="btn btn-success btn-lg my-2">Add New Manager </a>
    <table id="table_id" class="table table-responsive-md cell-border compact stripe table-dark my-4 text-dark">
        <thead>
            <tr class="text-white">
                <th>id</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>National_ID</th>
                <th>Gym-City</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>

@endsection
@section('javascripts')
    <script>
        $(document).ready( function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('gym-managers.index') }}"
            },
            columns:[
                {
                    data:'id',
                    name:'id',
                },
                {
                    data:'avatar',
                    name:'avatar',
                    render:function(data,type,full,meta)
                    {
                        return "<img src='images/"+data+"' width='60' style='border-radius:50%;' class='img-thumbnail'  />";
                    },
                    orderable:false
                },
                {
                    data:'name',
                    name:'name',
                },
                {
                    data:'email',
                    name:'email',
                },
                {
                    data:'national_id',
                    name:'national_id',
                },
                {
                    data:'gym-city',
                    name:'gym-city',
                },
               
                
                {
                    data:'action',
                    name:'action',
                    orderable:false,
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
           url: "{{ url('destroy-gym-manager') }}",
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
    function ban(id){
        if (confirm("Ban this member?") == true) {
        var id = id;
         // ajax
        $.ajax({
           type:"POST",
           url: "{{ url('ban-gym-manager') }}",
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
