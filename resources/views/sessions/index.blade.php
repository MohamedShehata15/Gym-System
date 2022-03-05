@extends('layouts.app')
@section('content')
<div class="text-center mydiv">
    <h1> Training Sessions</h1>
    <a href="{{route('sessions.create')}}" class="btn btn-success btn-lg my-2">Add Session</a>

    <table class="table cell-border compact stripe table-dark my-4 text-dark" id="myTable">
        <thead>
            <tr class="text-white">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Start-at</th>
                <th scope="col">Finish-at</th>
                <th scope="col">Coaches</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>
<!--****************************************edit modal*************************************-->
<div id="myModal" class="modal fade " data-bs-backdrop="static" bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered justify-content-sm-center ">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-dark">Edit Session</h5>
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">X
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{route('sessions.update')}}">
                    @csrf
                    @method('PUT')
                    <div>
                        <input name="id" type="hidden" class="form-control" id="id" aria-describedby="emailHelp">
                    </div>

                    <div>
                        <label for="exampleInputEmail1" class="form-label text-dark">Name</label>
                        <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>

                    <div>
                        <label class="form-label text-dark" for="Day">Day</label>
                        <input name="day" id="day" class="form-control" type="date" />
                    </div>

                    <div>
                        <label class="form-label text-dark" for="start">Start-time</label>
                        <input name="start" type="time" id="start" class="form-control" />
                    </div>

                    <div>
                        <label class="form-label text-dark" for="finish">finish-time</label>
                        <input name="finish" type="time" id="finish" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="form-label text-dark" for="exampleFormControlSelect2">Choose Coaches</label>
                        <select name="coaches[]" multiple class="form-control" id="coaches">

                        </select>
                    </div>
                    <form>
            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Update</button>
            </div>

        </div>
    </div>
</div>

@endsection




@section('javascripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{route('sessions.index')}}"
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'start_at',
                    name: 'start_at'
                },
                {
                    data: 'finish_at',
                    name: 'finish_at'
                },
                {
                    data: 'Coaches',
                    name: 'Coaches'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    function DeleteSession(id) {
        if (confirm("Do you want to delete this session?") == true) {
            var id = id;
            $.ajax({
                type: "POST",
                url: "{{ url('destroy') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (res) {
                    $('#myTable').DataTable().ajax.reload();
                },
                error: function () {
                    alert("There are people will attend this session you cannot delete it:(");
                }
            });
        }
    }

    function EditSession(id) {
        var id = id;
        $.ajax({
            type: "GET",
            url: "{{ url('edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function (data) {
                //get data and put it into the modal
                var startdate = (data.start_at).split(" ");
                var finishdate = (data.finish_at).split(" ");
                var day = startdate[0];
                var StartTime = startdate[1];
                var FinishTime = finishdate[1];
                var selectedCoaches = data.selectedCoaches;
                var coachesid = data.coachesid;
                var options = data.coaches;
                $('#id').val(id);
                $('#name').val(data.name);
                $('#day').val(day);
                $('#start').val(StartTime);
                $('#finish').val(FinishTime);
                $("#coaches").empty();
                for (var j = 0; j < options.length; j++) {
                    if (jQuery.inArray(coachesid[j], selectedCoaches) !== -1) {
                        $("#coaches").append(new Option(options[j], coachesid[j], true, true));
                    } else {
                        $("#coaches").append(new Option(options[j], coachesid[j]));
                    }
                }
                //show the modal
                var myModal = new bootstrap.Modal(document.getElementById("myModal"), {});
                myModal.show();
            }
        });
    }

</script>
@endsection
