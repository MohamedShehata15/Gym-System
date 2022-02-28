@extends('layouts.app')

@section('content')
<div class="text-center  mt-5">
    <h1 > Training Sessions</h1>
            <a href="{{route('sessions.create')}}" class="btn btn-success my-3">Add Session</a>

        </div>
        <table class="table table-hover table-dark table-bordered my-4">
            <thead>
              <tr class="text-center">
                <th  scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">start_at</th>
                <th scope="col">finish_at</th>
                <th scope="col">Coach</th>
                <th colspan="3"  scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <th scope="row">{{$session['id']}}</th>
                    <td>{{$session['name']}}</td>
                    <td>{{$session['start_at']}}</td>
                    <td>{{$session['finish_at']}}</td>
                    <td>Yara</td> <!-- coaches name-->

                    <td class="text-center"><a href="#" class="btn btn-info">View</a></td>
                    <td class="text-center"><a   href="#" class="btn btn-primary">Edit</a></td>
                    
                    <form method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <td class="text-center"><button  type="submit" class="btn btn-danger" onclick="return confirm('You are about to delete this session ,Are you sure')">Delete</button></td>
                    </form>

                </tr>
             

            @endforeach
            </tbody>
          </table>          
          @endsection