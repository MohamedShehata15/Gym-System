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
		@role('Super-Admin')
		<div class="mb-3">
			<label for="cities" class="form-label">Choose city</label>
			<select id="cities" class="form-select"  name="city_id">
				
				@foreach ($cities as $city )
					<option value="{{$city->id}}" {{ old('city_id')== $city->id? "selected": "" }} >{{$city->name}}</option>
				@endforeach
			  </select>			
		</div>
		@endrole
		<div class="mb-3">
			<label for="formFile" class="form-label">Choose Image</label>
			<input class="form-control" type="file" id="formFile" name="image"  >
		</div>
		<button class="btn btn-primary">Add</button>
	  </form>
  </div>   

 @endsection