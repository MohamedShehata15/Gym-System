@extends('layouts.app')

@section('content')
<div class="text-center  mt-5">
    <h1> Training Sessions</h1>
            <a href="{{route('sessions.create')}}" class="btn btn-success my-3">Add Session</a>
        </div>
        <section>
            <div class="container">
                <div class="col-md-12" >
                 {!! $dataTable->table() !!}
                </div>
        </div>
</section>
@endsection
@section('javascripts')
{!! $dataTable->scripts() !!}
          @endsection