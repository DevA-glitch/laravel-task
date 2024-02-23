/*
 * edit_model
 * */
function edit_modal(url) {
    $.get(url, function (response) {
        $('#editRecordModalContent').html(response);
        $('#editRecordModal').modal('show');
    }).fail(function (error) {
        toastr(error.responseJSON.message, "bg-danger");
    });
}
