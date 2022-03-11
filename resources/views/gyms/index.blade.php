{{-- @extends('layouts.app')

@section('content')
   
<style>
    img {
        width:75px;
    }
</style>

</head>
<body> 
    @if(Session::has('fail'))
        <div class="alert alert-danger">
        {{Session('fail')}}
    </div>
    {{Session()->forget('fail')}}
    @endif
    <table id="gyms" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>Created at</th>
                @if(Auth::user()->role=="admin")
                    <th>City Manager</th>
                @endif
                <th>Cover_Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-dark">
            @foreach ( $gyms as $gym )
                <tr>
                    <td>{{$gym->name}}</td>
                    <td>{{\Carbon\Carbon::parse($gym->created_at)->format('Y-M-D')}}</td>
                    @if(Auth::user()->role=="admin")
                         <td>{{$gym->city->cityManager->name}}</td>
                    @endif
                    <td><img src="../uploads/gyms/{{$gym->image}}" alt="notFounded" class="rounded-circle shadow"/></td>
                    <td>
                        <a href="{{route('gyms.show',['id' => $gym->id])}}" class="btn btn-info">Show</a>
                        <a href="{{route('gyms.edit',['id' => $gym->id])}}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$gym->id}}">
                            Delete
                        </button> --}}
                       {{-- //Model For Delete :) // --}}
                        {{-- <div class="modal fade" id="exampleModal{{$gym->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered"">
                              <div class="modal-content">
                                <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure that you want to delete this GYM? 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">No</button>
                                        <form action="{{route('gyms.destroy',['id' => $gym->id])}}" method="POST">
                                            @csrf
                                            @method('DELEtE')
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>    
                </tr> 
            @endforeach  
        </tbody>
    </table>  
  @endsection

  @section('script')
       <script>
           $(document).ready( function () {
           $('#gyms').DataTable();
           });
       </script>
   @endsection	    --}}


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

    function editFunc(id) {
        var id = id;
        $.ajax({
            type: "GET",
            url: `{{ url('gyms/${id}/edit') }}`,
            data: {
                id: id
            },
            dataType: 'json',
            success: function (data) {
                data.citieManagers.forEach(manager =>  {

                    $('#cityManager').append(`<option value="${manager.id}">${manager.name}</option>`);

                })
                data.gymManagers.forEach(manager =>  {

                    $('#gymManagers').append(`<option value="${manager.id}">${manager.name}</option>`);

                })

               $('#name').val(data.gym);

            //    $('#cityManager').val(data.citieManagers.name);
               $('#image').val(data.gym.image);
               $('#gymManagers').val(data.gymManagers.name);
           
                //show the modal
                var myModal = new bootstrap.Modal(document.getElementById("myModal"), {});
               myModal.show();
            }
            
        });
    }  


    function DeleteGym(id) {
        if (confirm("Do you want to delete this session?") == true) {
            var id = id;
            $.ajax({
                type: "POST",
                url: "{{ url('destroy') }}",
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