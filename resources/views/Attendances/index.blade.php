{{-- @extends('layouts.app')
@section('content')
   

</head>
<body> 
    <table id="attendace" class="display">
        <thead>
            <tr>
                <th>City</th>
                <th>Gym</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Session Name</th>
                <th>Session Time</th>
                <th>Session Date</th>
                
            </tr>
        </thead>
        <tbody class="text-dark">
            @foreach ($userTrainingPackages as $userTrainingPackage ) --}}
                 {{-- @dd(User::where('id',$UserTrainin->user_id)->get()); --}}
                 {{-- <tr>`
                     <td>City</td>
                     <td>Gym</td>
                     <td>{{$users::find($userTrainingPackage->user_id)}}</td> --}}
                     {{-- <td>{{$userTrainingPackage->users->name}}</td> --}}
                     {{-- <td>{{$userTrainingPackage->training_package_id}}</td>
                     <td>{{\Carbon\Carbon::parse($userTrainingPackage->date)->format('H:i:s') }}</td>
                     <td>{{\Carbon\Carbon::parse($userTrainingPackage->date)->format('Y-M-D') }}</td>                       
                 </tr>
            @endforeach     
        </tbody>
    </table>  
  @endsection

  @section('script')
       <script>
           $(document).ready( function () {
           $('#attendace').DataTable();
           });
       </script>
   @endsection	    --}}

   @extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')


<table id="attendanceTable" class="table table-bordered table-striped bg-light">
    <thead>
        <tr>
            <th>City</th>
            <th>Gym</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Session Name</th>
            <th>Session Time</th>
            <th>Session Date</th>
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
        $('#attendanceTable').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('attendances.index') }}"
            },
            columns:[
                // {
                //     data:'cityName',
                //     name:'cityName',
                // },
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
               
                // {
                //     data:'action',
                //     name:'action',
                //     orderable:false,

                // },
                
            ]
        });
    } );

  </script>  