@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="text-center mydiv">
    <table id="table_id" class="table table-responsive-md  cell-border compact stripe table-dark my-4 text-dark">
        <thead>
            <tr class="text-white">
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Package Name</th>
                <th>Paid Price</th>
                @can('gym-managers')
                <th>Gym</th>
                @endcan
                @role('Super-Admin')
                <th>City</th>
                @endrole
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
                url: "{{ route('purchases.index') }}"
            },
            columns:[

                {
                    data:'id',
                    name:'id',
                },   
                {
                    data:'userName',
                    name:'userName',
                },
                {
                    data:'email',
                    name:'email',
                },
                
                {
                    data:'packageName',
                    name:'packageName',
                },
                {
                    data:'price',
                    name:'price',
                    render: function(data) {return `$${data * 0.01}`}
                },
                @can('gym-managers')
                {
                    data:'gymName',
                    name:'gymName',
                },
                @endcan
                @role('Super-Admin')
                {
                    data:'cityName',
                    name:'cityName',
                },
                @endrole
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
        $.ajax({
           type:"POST",
           url: "{{ url('destroy-purchase') }}",
           data: { id: id },
           dataType: 'json',
           success: function(res){
            $('#table_id').DataTable().ajax.reload();
              },
            error:function(){ 
            alert("Cannot delete this record");
        }
         });
         
    }}
    </script>
@endsection
