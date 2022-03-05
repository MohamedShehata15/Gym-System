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
		<div class="mb-3">
			<label for="manager" class="form-label">Choose Manager</label>
			<select class="form-select"  name="staff_id">
				@foreach ($staff as $manager )
					<option value="{{$manager->id}}">{{$manager->name}}</option>
				@endforeach
			  </select>	
	     </div>		
		<div class="mb-3">
			<label for="cities" class="form-label">Choose city</label>
			<select id="cities" class="form-select"  name="city_id">
				@foreach ($cities as $city )
					<option value="{{$city->id}}">{{$city->name}}</option>
				@endforeach
			  </select>			
		</div>	
		<div class="mb-3">
			<label for="formFile" class="form-label">Choose Image</label>
			<input class="form-control" type="file" id="formFile" name="image"value="{{$gym->image}}">
		</div>
		<input type="hidden" name="id" value="{{ $gym->id }}">
		<button type="submit" class="btn btn-primary">Update</button>
	  </form>
  </div>   

 @endsection