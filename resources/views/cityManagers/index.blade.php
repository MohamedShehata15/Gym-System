@extends('layouts.app')

@section('content')
   

</head>
<body>
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Started at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $cityManagers as $cityManager )
            {{-- @dd($cityManager->id) --}}
                <tr>
                    <td>{{$cityManager->name}}</td>
                    <td>{{$cityManager->email}}</td>
                    <td>{{\Carbon\Carbon::parse($cityManager->created_at)->format('Y-M-D')}}</td>
                    <td>
                        <a href="{{route('cityManagers.show',['id' => $cityManager->id])}}" class="btn btn-info">Show</a>
                        <a href="{{route('cityManagers.edit',['id' => $cityManager->id])}}" class="btn btn-warning">Edit</a>
                        <a  href="{{route('cityManagers.ban',['id' => $cityManager->id])}}" 
                        @if ($cityManager->is_baned==0)                       
                            class="btn btn-success ">Ban                          
                            @elseif ($cityManager->is_baned==1)
                            class="btn btn-dark ">Unban
                        @endif
                        </a>
                        

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$cityManager->id}}">
                            Delete
                        </button>
                       {{-- //Model For Delete :) // --}}
                        <div class="modal fade" id="exampleModal{{$cityManager->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <form action="{{route('cityManagers.destroy',['id' => $cityManager->id])}}" method="POST">
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