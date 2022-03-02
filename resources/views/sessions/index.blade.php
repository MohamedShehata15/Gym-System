@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class="text-white "> Training Sessions</h1>
            <a href="{{route('sessions.create')}}" class="btn btn-success my-3">Add Session</a>
        
        <table class="table cell-border compact stripe table-dark my-4 text-dark" id="myTable">
            <thead>
              <tr class="text-white">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Start-at</th>
                <th scope="col">Finish-at</th>
                <th scope="col">Coaches</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        </div >

@endsection
@section('javascripts')
<script>
    $(document).ready(function(){
       $('#myTable').DataTable({
           processing:true,
           serverSide:true,
           ajax:{
               url:"{{route('sessions.index')}}"    
           },
           columns:[

            {
                   data:'id',
                   name:'id'
               },
               {
                   data:'name',
                   name:'name'
               },
               {
                   data:'start_at',
                   name:'start_at'
               },
               {
                   data:'finish_at',
                   name:'finish_at'
               },
               {
                   data:'Coaches',
                   name:'Coaches'
               },
               {
                   data:'action',
                   name:'action',
                   orderable:false
               }
            ]
       });

    });
</script>
          @endsection