<div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Edit student</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <form id="update_student" autocomplete="off">
        @csrf
        @method('PUT')
        <input type="hidden" name="student_id" id="edit_student_id" value="{{ encrypt($student->id) }}">
    
        <div class="form-group mb-3">
            <label for="name" class="required">Name</label>
            <input type="name" name="name" required id="edit_name" value="{{ $student->name }}" class="form-control" placeholder="Enter name">
            <span class="invalid-feedback" id="edit_name_error"></span>
        </div>

        <div class="form-group mb-3">
            <label for="email" class="required">Email</label>
            <input type="email" name="email" required id="edit_email" value="{{ $student->email }}" class="form-control" placeholder="Enter email">
            <span class="invalid-feedback" id="edit_email_error"></span>
        </div>
    
        <div class="form-group mb-3">
            <label for="number" class="required">Mobile Number</label>
            <input type="number" name="number" required id="edit_number" value="{{ $student->number }}" class="form-control" placeholder="Enter number">
            <span class="invalid-feedback" id="edit_number_error"></span>
        </div>
    
        <div class="form-group mb-3">
            <label for="roll_number" class="required">Roll Number</label>
            <input type="text" name="roll_number" required maxlength="6" id="edit_roll_number" value="{{ $student->roll_number }}" class="form-control" placeholder="Enter roll number">
            <span class="invalid-feedback" id="edit_roll_number_error"></span>
        </div>
    
        <div class="form-group mb-3">
            <label for="type">Student Type</label>
            <select name="type" id="edit_type" class="form-control">
                <option value="">--SELECT--</option>
                <option value="hostel" {{ $student->type == 'hostel' ? 'selected' : '' }}>Hostel</option>
                <option value="day_scholar" {{ $student->type == 'day_scholar' ? 'selected' : '' }}>Day Scholar</option>
            </select>
            <span class="invalid-feedback" id="edit_type_error"></span>
        </div>
    
        <div class="form-group mb-3">
            <label for="address" class="required">Student Address</label>
            <textarea name="address" required id="edit_address" class="form-control" placeholder="Enter address">{{ $student->address }}</textarea>
            <span class="invalid-feedback" id="edit_address_error"></span>
        </div>
    
        <center>
            <button type="submit" id="update_student_btn" class="btn btn-block btn-primary">Update</button>
        </center>
    </form>
    
</div>
<script>
   

    $('#update_student').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('student.update') }}",
            method: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('#update_student_btn').attr('disabled', true);
                $('#update_student_btn').html(window.spinner);
            },
        }).done((response, statusText, xhr) => {
            $(".error-text").text("");
            $(".form-control").removeClass("is-invalid");
            $('#update_student_btn').removeAttr('disabled');
            $('#update_student_btn').html('update');


            if (xhr.status == 200) {

                $("#datatable").DataTable().ajax.reload();

                let myOffCanvas = document.getElementById('offcanvasRight');
                let openedCanvas = bootstrap.Offcanvas.getInstance(myOffCanvas);
                openedCanvas.hide();
                toastr(response.message, "bg-success");
            }

        }).fail((error) => {
            $(".error-text").text("");
            $(".form-control").removeClass("is-invalid");
            $('#update_student_btn').removeAttr('disabled');
            $('#update_student_btn').html('update');

            if (error.status == 422) {

                $.each(error.responseJSON, function(key, val) {
                    $("#edit_" + key).addClass("is-invalid");
                    $("#edit_" + key + "_error").text(val[0]);
                });
            } else {
                toastr(error.responseJSON.message, "bg-danger");
            }
        });
    });
</script>