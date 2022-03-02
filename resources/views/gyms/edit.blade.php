@extends('layouts.app')

@section('content')
   

</head>
<body>
    <h2>Edit GYM :</h2>
  <div class="container">  
	<form method="post" action="{{route("gyms.update",['id' => $gym->id])}}" enctype="multipart/form-data">
		@csrf
        @method('PUT')
		<div class="mb-3">
		  <label for="gymName" class="form-label">Name</label>
		  <input type="text" class="form-control" id="gymName" name="name" value="{{$gym->name}}">
		</div>		
		<label for="manager" class="form-label">Choose Manager</label>
		<select class="form-select"  name="staffs_id">
			@foreach ($users as $user )
				<option  {{$gym->staffs_id == $user->id? "Selected" :""}} value="{{$user->id}}">{{$user->name}}</option>
			@endforeach
		  </select>		
		<div class="mb-3">
			<label for="formFile" class="form-label">Choose Image</label>
			<input class="form-control" type="file" id="formFile" name="image"value="{{$gym->image}}">
		</div>
		<button type="submit" class="btn btn-primary">Update</button>
	  </form>
  </div>   

 @endsection