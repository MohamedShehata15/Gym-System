@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <table id="table_id" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Package Name</th>
                <th>Paid Price</th>
                @role('city_manager')
                <th>Gym</th>
                @endrole
                @role('Super-Admin')
                <th>City</th>
                @endrole
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
                },
                @role('city_manager')
                {
                    data:'gymName',
                    name:'gymName',
                },
                @endrole
                @role('Super-Admin')
                {
                    data:'cityName',
                    name:'cityName',
                }
                ,
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
