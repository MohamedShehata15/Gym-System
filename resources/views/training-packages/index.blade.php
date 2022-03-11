@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="text-center mydiv">
    <a href="{{route('training-packages.create')}}" class="btn btn-success" > Add New Package </a>
    <table id="table_id" class="table table-responsive-sm  cell-border compact stripe table-dark my-4 text-dark">
        <thead>
            <tr class="text-white">
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>Session Number</th>
                <th>Gym Name</th>
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
                url: "{{ route('training-packages.index') }}"
            },
            columns:[
                {
                    data:'id',
                    name:'id',
                },
                {
                    data:'name',
                    name:'name',
                },
                {
                    data:'price',
                    name:'price',
                    render:function(data,type,full,meta)
                    {
                        return (data*0.01+'$');
                    }
                },
               
                {
                    data:'session_number',
                    name:'session_number',
                },
                {
                    data:'GymName',
                    name:'GymName',
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
        if (confirm("Delete Record?") == true) {
        var id = id;
         // ajax
        $.ajax({
           type:"POST",
           url: "{{ route('training-packages.destroy') }}",
           data: { id: id },
           dataType: 'json',
           success: function(res){
               $('#table_id').DataTable().ajax.reload();
              },
            error:function(res){ 
            alert("Cannot Delete Package");
        }
         });
    }}

    </script>
@endsection