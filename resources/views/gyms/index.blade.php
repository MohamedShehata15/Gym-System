@extends('layouts.app')

@section('content')
   

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
                <th>updated time</th>
                <th>revenue</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-dark">
            @foreach ( $gyms as $gym )
                <tr>
                    <td>{{$gym->name}}</td>
                    <td>{{\Carbon\Carbon::parse($gym->created_at)->format('Y-M-D')}}</td>
                    <td>{{\Carbon\Carbon::parse($gym->updated_at)->format('Y-M-D')}}</td>
                    <td>{{$gym->revenue}}</td>
                    <td>
                        <a href="{{route('gyms.show',['id' => $gym->id])}}" class="btn btn-info">Show</a>
                        <a href="{{route('gyms.edit',['id' => $gym->id])}}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$gym->id}}">
                            Delete
                        </button>
                       {{-- //Model For Delete :) // --}}
                        <div class="modal fade" id="exampleModal{{$gym->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
   @endsection	   
