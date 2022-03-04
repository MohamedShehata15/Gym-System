@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endsection
@section('content')
    <br>
<div class="d-flex justify-content-center mb-2">
    <a href="{{route('training-packages.create')}}" class="btn btn-success" > Add New Package </a>
  </div>
    <table id="table_id" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>Session Number</th>
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
        $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('training-package.index') }}"
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
                },
               
                {
                    data:'session_number',
                    name:'session_number',
                },
               
               
                {
                    data:'action',
                    name:'action',
                    orderable:false,


                },
                
            ]
        });
    } );
<<<<<<< HEAD:resources/views/training-packages/index.blade.php
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
            alert("this city has gyms");
        }
         });
    }}
=======
>>>>>>> 6a7f8e828a24d79458b2d8826472f9db85ff9dc2:resources/views/training-package/index.blade.php
    </script>
@endsection