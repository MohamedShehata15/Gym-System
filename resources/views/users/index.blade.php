@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<br>
<div class="text-center mydiv">
    <table id="table_id" class="table table-responsive-md  cell-border compact stripe table-dark my-4 text-dark">
        <thead>
            <tr class="text-white">
                <th>ID</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Gym</th>
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
                url: "{{ route('users.index') }}"
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
                    width:'30px',
                },
                {
                    data:'gender',
                    name:'gender',
                },
                {
                    data:'gym',
                    name:'gym',
                    orderable:false,
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
        if (confirm("Do you want to delete this user ?") == true) {
        var id = id;
         // ajax
        $.ajax({
           type:"POST",
           url: "{{ route('users.destroy')}}",
           data: { id: id },
           dataType: 'json',
           success: function(res){
               $('#table_id').DataTable().ajax.reload();
              },
            error:function(res){ 
            alert("Failed");
        }
         });
    }}
    
    </script>
@endsection