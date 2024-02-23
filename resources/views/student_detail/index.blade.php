@extends('layouts.main')
@section('title', 'LARAVEL TASK | STUDENT DETAILS')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
    
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Student</h4>
                    </div>
                    <div class="card-body">
                        <form id="add" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="name" class="required">Name</label>
                                        <input type="text" name="name" maxlength="50" id="name" class="form-control" placeholder="Enter name">
                                        <span class="invalid-feedback" id="name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="email" class="required">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                                        <span class="invalid-feedback" id="email_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="number" class="required">Mobile Number</label>
                                        <input type="number" name="number" maxlength="10" id="number" class="form-control" placeholder="Enter number">
                                        <span class="invalid-feedback" id="number_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="roll_number" class="required">Roll Number</label>
                                        <input type="text" name="roll_number" maxlength="6" id="roll_number" class="form-control" placeholder="Enter roll number">
                                        <span class="invalid-feedback" id="roll_number_error"></span>
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="type">Student Type</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="">--SELECT--</option>
                                                <option value="hostel">Hostel</option>
                                                <option value="day_scholar">Day Scholar</option>
                                            </select>
                                            <span class="invalid-feedback" id="type_error"></span>
                                        </div>
                                    </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="address" class="required">Student Address</label>
                                        <textarea type="text" name="address"  id="address" class="form-control" placeholder="Enter address"></textarea>
                                        <span class="invalid-feedback" id="address_error"></span>
                                    </div>
                                </div>
    
                            </div>

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button id="save" class="btn btn-success" type="submit">submit</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage Student</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Roll Number</th>
                                        <th>Student Type</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
@include('_includes.offcanvas.right')
@include('_includes.modals.delete_modal')
@endsection

@push('scripts')
<script src="{{ url('assets/js/main/canvas.js') }}"></script>
<script src="{{ url('assets/js/main/delete.js') }}"></script>


<script>
    /**
     * add bank
     * */
    $('#add').submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('student.store') }}",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('#save').attr('disabled', true);
                $('#save').html(window.spinner);
            },
        }).done((response, statusText, xhr) => {
            $(".error-text").text("");
            $(".form-control").removeClass("is-invalid");
            $('#save').removeAttr('disabled');
            $('#save').html('submit');

            if (xhr.status == 201) {
                $("#add")[0].reset();
                $("#datatable").DataTable().ajax.reload();
                toastr(response.message, "bg-success");
            }
            if (xhr.status == 200) {
                toastr(response.message, "bg-success");
            }
        }).fail((error) => {
            $(".error-text").text("");
            $(".form-control").removeClass("is-invalid");
            $('#save').removeAttr('disabled');
            $('#save').html('submit');

            if (error.status == 422) {
                $.each(error.responseJSON, function(key, val) {
                    $("#" + key).addClass("is-invalid");
                    $("#" + key + "_error").text(val[0]);
                });
            } else {
                toastr(error.responseJSON.message, "bg-danger");
            }
        });
    });

    $("#datatable").DataTable({
        responsive: true,
        language: {
            searchPlaceholder: "",
        },
        ordering: false,
        processing: false,
        serverSide: true,
        serverMethod: "POST",
        ajax: {
            url: "{{ route('student.datatable') }}",
            beforeSend: () => {
                $("#banks_datatable > tbody").html(
                    '<tr class="odd">' +
                    '<td valign="top" colspan="5" class="dataTables_empty">Loading&hellip;</td>' +
                    "</tr>"
                );
            },
        },
        columns: [{
                data: "sl",
            }, {
                data: "name",
            }, 
            {
                data: "email",
            }, 
            {
                data: "number",
            }, 
            {
                data: "roll_number",
            }, 
            {
                data: "type",
            }, 
            {
                data: "address",
            }, 
            {
                data: "action",
            }, 
        ],

    });


</script>
@endpush