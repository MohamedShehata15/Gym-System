@extends('layouts.app')

@section('content')
   

</head>
<body>
	<h2>Create GYM :</h2>
  <div class="container">  
	<form method="post" action="{{route("gyms.store")}}" enctype="multipart/form-data">
		@csrf
		<div class="mb-3">
		  <label for="gymName" class="form-label">Name</label>
		  <input type="text" class="form-control" id="gymName" name="name">
		</div>		
		<label for="manager" class="form-label">Choose Manager</label>
		<select class="form-select"  name="staffs_id">
			@foreach ($users as $user )
				<option value="{{$user->id}}">{{$user->name}}</option>
			@endforeach
		  </select>		
		<div class="mb-3">
			<label for="formFile" class="form-label">Choose Image</label>
			<input class="form-control" type="file" id="formFile" name="image">
		</div>
		<button class="btn btn-primary">Add</button>
	  </form>
  </div>   

 @endsection