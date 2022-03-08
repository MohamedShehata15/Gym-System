@extends('layouts.app')
@section('content')
   

</head>
<body> 
    <table id="attendace" class="display">
        <thead>
            <tr>
                <th>City</th>
                <th>Gym</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Session Name</th>
                <th>Session Time</th>
                <th>Session Date</th>
                
            </tr>
        </thead>
        <tbody class="text-dark">
            @foreach ($userTrainingPackages as $userTrainingPackage )
                 {{-- @dd(User::where('id',$UserTrainin->user_id)->get()); --}}
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
  @endsection

  @section('script')
       <script>
           $(document).ready( function () {
           $('#attendace').DataTable();
           });
       </script>
   @endsection	   
