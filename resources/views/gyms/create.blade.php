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
		  <input type="text" class="form-control" id="gymName" name="name"value="{{ old('name') }}">
		</div>
		<div class="mb-3">
			<label for="manager" class="form-label">Choose Manager</label>
			<select id="manager" class="form-select"  name="staff_id">
				@foreach ($staff as $manager )
				<option value="{{$manager->id}}" {{ old('staff_id')== $manager->id? "selected": "" }}>{{$manager->name}}</option>
				@endforeach
			</select>			
		</div>
		<div class="mb-3">
			<label for="cities" class="form-label">Choose city</label>
			<select id="cities" class="form-select"  name="city_id">
				@foreach ($cities as $city )
					<option value="{{$city->id}}" {{ old('city_id')== $city->id? "selected": "" }} >{{$city->name}}</option>
				@endforeach
			  </select>			
		</div>		
		<div class="mb-3">
			<label for="formFile" class="form-label">Choose Image</label>
			<input class="form-control" type="file" id="formFile" name="image"  >
		</div>
		<button class="btn btn-primary">Add</button>
	  </form>
  </div>   

 @endsection