@extends('layouts.app')
@section('third_party_stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="text-center mydiv">
    <h1> Gyms</h1>
    <a href="{{route('gyms.create')}}" class="btn btn-success btn-lg my-2">Add Gym</a>

<table id="table_id" class="table table-responsive-md  cell-border compact stripe table-dark my-4 text-dark">
    <thead>
        <tr class="text-white">
            <th>Name</th>
                <th>Created at</th>
                @if(Auth::user()->hasRole("Super-Admin"))
                    <th>City Manager</th>
                @endif 
                <th>Cover_Image</th>
                <th>Action</th>
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
                url: "{{ route('gyms.index') }}"
            },
            columns:[
                {
                    data:'name',
                    name:'gym.name',
                },
                {
                    data:'created_at',
                    name:'created_at',
                },
                {
                  data:'cityManager',
                  name: 'cityManager',
                  orderable:false,
                },
                {
                  data:'gymImage',
                  name: 'gymImage',
                },
               
                {
                    data:'action',
                    name:'action',
                    orderable:false,

                },
                
            ]
        });
    });



    function DeleteGym(id) {
        if (confirm("Do you want to delete this gym?") == true) {
            var id = id;
            $.ajax({
                type: "POST",
                url: "{{ url('destroy-gym') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    $('#table_id').DataTable().ajax.reload();
                },
                error: function () {
                    alert("There are sessions in this gym you cannot delete it");
                }
            });
        }
    }

  </script>  
@endsection
