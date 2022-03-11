@extends('layouts.app')

@section('content')
   

</head>
<body>
	<div class=" mydiv">
	<h2 class="text-center">Edit GYM </h2>

	<form method="post" class="row d-flex flex-column justify-content-center align-items-center" action="{{route("gyms.update",['id' => $gym->id])}}" enctype="multipart/form-data">
		@csrf
        @method('PUT')
		<div class="mb-3 col-sm-6">
		  <label for="gymName" class="form-label">Name</label>
		  <input type="text" class="form-control" id="gymName" name="name" value="{{$gym->name}}">
		</div>	
		@role('Super-Admin')
		<div class="mb-3 col-sm-6">
			<label for="cities" class="form-label">Choose city</label>
			<select id="cities" class="form-select"  name="city_id">
				<option value="" disabled selected hidden>choose a City</option> 
				@foreach ($cities as $city )
					<option value="{{$city->id}}" {{$city->id == $gym->city_id ? "selected" : ""}}>{{$city->name}}</option>
				@endforeach
			  </select>			
		</div>	
		@endrole
		<div class="mb-3 col-sm-6">
			<label for="formFile" class="form-label">Choose Image</label>
			<input class="form-control" type="file" id="formFile" name="image"value="{{$gym->image}}">
		</div>
		<input type="hidden" name="id" value="{{ $gym->id }}">
		<button type="submit" class="btn btn-primary">Update</button>
	  </form>
  </div>   

 @endsection