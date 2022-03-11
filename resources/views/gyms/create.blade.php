{{-- @dd($staff); --}}
@extends('layouts.app')

@section('content')
<div class=" mydiv">
	<h2 class="text-center">Create New GYM </h2>
	<form method="post" class="row d-flex flex-column justify-content-center align-items-center" action="{{route("gyms.store")}}" enctype="multipart/form-data">
		@csrf
		<div class="mb-3 col-sm-6">
		  <label for="gymName" class="form-label">Name</label>
		  <input type="text" class="form-control" id="gymName" name="name" value="{{ old('name') }}">
		</div>
		@role('Super-Admin')
		<div class="mb-3 col-sm-6">
			<label for="cities" class="form-label">Choose city</label>
			<select id="cities" class="form-select"  name="city_id">
				
				@foreach ($cities as $city )
					<option value="{{$city->id}}" {{ old('city_id')== $city->id? "selected": "" }} >{{$city->name}}</option>
				@endforeach
			  </select>			
		</div>
		@endrole
		<div class="mb-3 col-sm-6">
			<label for="formFile" class="form-label">Choose Image</label>
			<input class="form-control" type="file" id="formFile" name="image"  >
		</div>
		<button class="btn btn-success">Create</button>
	  </form>
  </div>  
 
 @endsection
 