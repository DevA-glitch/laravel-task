function cofirm_modal(url, refresh_table_name) {
    $("#confirm_url").val(url);
    $("#refresh_table_name").val(refresh_table_name);
    $("#delete-modal").modal("show");
}

function deleteData() {
    var url = $("#confirm_url").val();

    var refresh_table_name = $("#refresh_table_name").val();

    $.ajax({
        url: url,
        method: "DELETE",
    })
        .done((response) => {
            $("#" + refresh_table_name)
                .DataTable()
                .ajax.reload();
            $("#delete-modal").modal("hide");
            toastr(response.message, "bg-success");
        })
        .fail((error) => {
            toastr(error.responseJSON.message, "bg-danger");
        });
}
