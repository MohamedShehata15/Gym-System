@extends('layouts.app')
@section('content')
   

</head>
<body> 
<div class="text-center mydiv">
    <table id="table_id" class="table table-responsive-sm  cell-border compact stripe table-dark my-4 text-dark">
        <thead>
            <tr class="text-white">
                <th>City</th>
                <th>Gym</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Session Name</th>
                <th>Session Time</th>
                <th>Session Date</th>
                
            </tr>
        </thead>
        <tbody>
          @foreach ($userTrainingPackages as $userTrainingPackage )
                 <tr>
                     <td>City</td>
                     <td>Gym</td>
                     <td>{{$userTrainingPackage->user_id}}</td>
                     <td>{{$userTrainingPackage->Users->where('id',$userTrainingPackage->user_id)}}</td>
                     <td>{{$userTrainingPackage->training_package_id}}</td>
                     <td>{{\Carbon\Carbon::parse($userTrainingPackage->date)->format('H:i:s') }}</td>
                     <td>{{\Carbon\Carbon::parse($userTrainingPackage->date)->format('Y-M-D') }}</td>                       
                 </tr>
            @endforeach     
        </tbody>
    </table> 
</div> 
  @endsection

  @section('script')
       <script>
           $(document).ready( function () {
           $('#table_id').DataTable();
           });
       </script>
   @endsection	   
