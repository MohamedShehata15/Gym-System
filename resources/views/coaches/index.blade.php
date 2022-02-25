@extends('layouts.app')

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Coaches </h3>
  
      <div class="card-tools">
        <!-- This will cause the card to maximize when clicked -->
        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
        <!-- This will cause the card to collapse when clicked -->
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <!-- This will cause the card to be removed when clicked -->
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      Coaches
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  @endsection