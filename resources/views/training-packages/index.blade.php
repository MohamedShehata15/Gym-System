@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <br>
<div class="d-flex justify-content-center mb-2">
    <a class="btn btn-success" > Add New Package </a>
  </div>
    <table id="table_id" class="table table-bordered table-striped">
        <thead>
            <tr>
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
                        return (data*0.01)+'  $';
                    },
                },
               
                {
                    data:'session_number',
                    name:'session_number',
                },
                {
                    data:'gymName',
                    name:'gymName',
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
        console.log(id); 
         // ajax
        $.ajax({
           type:"POST",
           url: "{{ url('destroy-training-package') }}",
           data: { id: id },
           dataType: 'json',
           success: function(res){  
            $('#table_id').DataTable().ajax.reload();
              },
            error:function(){ 
            alert("Failed");
        }
         });
        }
    }
    </script>
@endsection