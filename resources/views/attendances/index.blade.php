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
                <th>City</th>
                <th>Gym</th>
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
                url: "{{ route('attendances.index') }}"
            },
            columns:[
                {
                    data:'cityName',
                    name:'cityName',
                },
                {
                    data:'gymName',
                    name:'gymName',
                },
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