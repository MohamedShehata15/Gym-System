@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="text-center mydiv">
    <a
      class="btn btn-success"
      onClick="add()"
      
    >
      Add New City</a
    >


    <table id="table_id" class="table table-responsive-sm  cell-border compact stripe table-dark my-4 text-dark">
        <thead>
            <tr class="text-white">
                <th>id</th>
                <th>name</th>
                <th>City Manager</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>


    <!-- boostrap City model -->
<div class="modal fade" id="city-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="CityModal"></h4>
    </div>
    <div class="modal-body">
    <form action="javascript:void(0)" id="CityForm" name="CityForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id">
    <div class="form-group">
    <label for="name" class="col-sm-2 control-label">City Name</label>
    <div class="col-sm-12">
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter City Name" maxlength="50" required="">
    </div>
    </div>
    <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" class="btn btn-primary" id="btn-save">Save changes
    </button>
    </div>
    </form>
    </div>
    <div class="modal-footer">
    </div>
    </div>
    </div>
    </div>
    <!-- end bootstrap model -->
@endsection
@section('javascripts')
    <script>

        $(document).ready( function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('cities.index') }}"
            },
            columns:[
                {
                    data:'id',
                    name:'city.id',
                },
                {
                    data:'name',
                    name:'city.name',
                },
                {
                  data:'cityManagers',
                  name: 'cityManagers',
                  orderable:false,
                },
               
                {
                    data:'action',
                    name:'action',
                    orderable:false,

                },
                
            ]
        });
    } );

    function add() {
      $("#CityForm").trigger("reset");
      $("#CityModal").html("Add New City");
      $("#city-modal").modal("show");
      $("#id").val("");
    }
    function editFunc(id) {
      $.ajax({
        type: "POST",
        url: "{{ url('edit-city') }}",
        data: { id: id },
        dataType: "json",
        success: function (res) {
          $("#CityModal").html("Edit City");
          $("#city-modal").modal("show");
          $("#id").val(res.id);
          $("#name").val(res.name);
        },
      });
    }
    function deleteFunc(id){
        if (confirm("Delete Record?") == true) {
        var id = id;
         // ajax
        $.ajax({
           type:"POST",
           url: "{{ url('destroy-city') }}",
           data: { id: id },
           dataType: 'json',
           success: function(res){
               $('#table_id').DataTable().ajax.reload();
              },
            error:function(res){ 
            alert("this city has gyms");
        }
         });
         
    }}

    $("#CityForm").submit(function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      
      $.ajax({
        type: "POST",
        url: "{{ url('store-city')}}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            $("#city-modal").modal("hide");
            $('#table_id').DataTable().ajax.reload();
          $("#btn-save").html("Submit");
          $("#btn-save").attr("disabled", false);
        },
        error: function (data) {
          alert("Failed to Save Data");
        },
      });
    });
    </script>
@endsection
