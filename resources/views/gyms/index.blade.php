@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="text-center mydiv">
    <h1> Gyms</h1>
    <a href="{{route('gyms.create')}}" class="btn btn-success btn-lg my-2">Add Gym</a>

<table id="gymsTable" class="table table-bordered table-striped bg-light">
    <thead>
        <tr>
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

<div id="myModal" class="modal fade " data-bs-backdrop="static" bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-sm-center ">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-dark">Edit Gym</h5>
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">X
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div>
                        <input name="id" type="hidden" class="form-control" id="id" aria-describedby="emailHelp">
                    </div>

                    <div>
                        <label for="exampleInputEmail1" class="form-label text-dark">Gym Name</label>
                        <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>

                    <div>
                        <label class="form-label text-dark" for="cityManager">City Manager</label>
                        <select name="cityManager" class="form-control" id="cityManager">

                        </select>
                    </div>

                    <div>
                        <label class="form-label text-dark" for="start">Gym Image</label>
                        <input name="image" type="file" id="image" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="form-label text-dark" for="exampleFormControlSelect2">Choose Gym Managers</label>
                        <select name="gymManagers[]" multiple class="form-control" id="gymManagers">

                        </select>
                     </div>
                    <form>
            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update</button>
            </div>

        </div>
    </div>
</div>

@endsection
@section('third_party_scripts')
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js" defer></script>
    <script>
         $(document).ready( function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $('#gymsTable').DataTable({
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
                //   render:function(data,type,full,meta)
                //     {
                //         return "<img src='../uploads/gyms/data'" width='70' class='img-thumbnail'  />";
                //     }
                //   orderable:false,
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
        if (confirm("Do you want to delete this session?") == true) {
            var id = id;
            $.ajax({
                type: "POST",
                url: "{{ url('destroy-gym') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    $('#gymsTable').DataTable().ajax.reload();
                },
                error: function () {
                    alert("There are people will attend this session you cannot delete it...");
                }
            });
        }
    }

  </script>  
