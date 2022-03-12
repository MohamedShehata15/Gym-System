@extends('layouts.app')
@section('third_party_stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="text-center mydiv">
    <h1> User Attendance</h1>

    <table id="table_id" class="table table-responsive-sm  cell-border compact stripe table-dark my-4 text-dark">
        <thead>
            <tr class="text-white">
            @can('gym-managers')
            @can('city-managers')
                <th>City</th>
             @endcan
                <th>Gym</th>
                @endcan
                <th>User Name</th>
                <th>User Email</th>
                <th>Session Name</th>
                <th>Session Start At</th>
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
                url: "{{ route('attendances.index') }}"
            },
            columns:[
                @can('gym-managers')
                @can('city-managers')

                {
                    data:'cityName',
                    name:'cityName',
                },
                @endcan

                {
                    data:'gymName',
                    name:'gymName',
                },
                @endcan
                {
                  data:'userName',
                  name: 'userName',
                },
                {
                  data:'userEmail',
                  name: 'userEmail',
                },
               
                {
                    data:'sessionName',
                    name:'sessionName',

                },
                {
                    data:'sessionTime',
                    name:'sessionTime',

                },
                
            ]
        });
    } );

  </script>  
@endsection
