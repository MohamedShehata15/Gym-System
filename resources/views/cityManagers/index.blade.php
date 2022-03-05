@extends('layouts.app')

@section('content')
   

</head>
<body>
    <table id="city_manager" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Started at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
         @foreach ($cityGyms as $cityGym)
            @foreach ( $cityGym->gymManager as $gymManager )
                  <tr>
                    <td>{{$gymManager->name}}</td>
                    <td>{{$gymManager->email}}</td>
                    <td>{{\Carbon\Carbon::parse($gymManager->created_at)->format('Y-M-D')}}</td>
                    <td>
                        <a href="{{route('cityManagers.show',['id' => $gymManager->id])}}" class="btn btn-info">Show</a>
                        <a href="{{route('cityManagers.edit',['id' => $gymManager->id])}}" class="btn btn-warning">Edit</a>
                        <a  href="{{route('cityManagers.ban',['id' => $gymManager->id])}}" 
                        @if ($gymManager->is_baned==0)                       
                            class="btn btn-success ">Ban                          
                            @elseif ($gymManager->is_baned==1)
                            class="btn btn-dark ">Unban
                        @endif
                        </a>
                        

                         <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$gymManager->id}}">
                            Delete
                        </button> 
                       {{-- //Model For Delete :) // --}}
                         <div class="modal fade" id="exampleModal{{$gymManager->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <form action="{{route('cityManagers.destroy',['id' => $gymManager->id])}}" method="POST">
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
        @endforeach   
     </tbody>
    </table>  
  @endsection

  @section('script')
       <script>
           $(document).ready( function () {
           $('#city_manager').DataTable();
           });
       </script>
   @endsection