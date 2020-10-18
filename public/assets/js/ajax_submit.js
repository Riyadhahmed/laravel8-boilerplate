// reload ajax table
function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax
}

/*
 * View record details
 * parameters route as controller route name
 * id as record id
 */

function ajax_submit_view(route, id) {
    $("#modal_data").empty();
    $('.modal-title').text('View Details'); // Set Title to Bootstrap modal title

    $.ajax({
        url: route + '/' + id,
        type: 'get',
        success: function (data) {
            $("#modal_data").html(data.html);
            $('#myModal').modal('show'); // show bootstrap modal
        },
        error: function (result) {
            $("#modal_data").html("Sorry Cannot Load Data");
        }
    });
}


/*
 * record insert form
 * parameters route as controller route name
 */

function ajax_submit_create(route) {
    $("#modal_data").empty();
    $('.modal-title').text('Add New'); // Set Title to Bootstrap modal title

    $.ajax({
        type: 'GET',
        url: route + '/create',
        success: function (data) {
            $("#modal_data").html(data.html);
            $('#myModal').modal('show'); // show bootstrap modal
        },
        error: function (result) {
            $("#modal_data").html("Sorry Cannot Load Data");
        }
    });
}

/*
 * record store function
 * parameters route as controller route name
 * * CSRF_TOKEN in head.php
 */
function ajax_submit_store(route) {

    $('#create').validate({
        submitHandler: function (form) {

            var myData = new FormData($("#create")[0]);
            myData.append('_token', CSRF_TOKEN);

            swal({
                title: "Are you sure to submit?",
                text: "Submit Form",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Submit!"
            }, function () {

                $.ajax({
                    url: route,
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.type === 'success') {
                            $('#myModal').modal('hide');
                            swal("Done!", "It was succesfully done!", "success");
                            reload_table();
                        } else if (data.type === 'error') {
                            if (data.errors) {
                                $.each(data.errors, function (key, val) {
                                    $('#error_' + key).html(val);
                                });
                            }
                            $("#status").html(data.message);
                            swal("Error sending!", "Please fix the errors", "error");
                        }
                    }
                });
            });
        }
    });

}

/*
 * record edit form
 * parameters route as controller route name
 * id as record id
 */

function ajax_submit_edit(route, id) {
    $("#modal_data").empty();
    $('.modal-title').text('Edit data');

    $.ajax({
        url: route + '/' + id + '/edit',
        type: 'get',
        success: function (data) {
            $("#modal_data").html(data.html);
            $('#myModal').modal('show'); // show bootstrap modal
        },
        error: function (result) {
            $("#modal_data").html("Sorry Cannot Load Data");
        }
    });
}


/*
 * record update function
 * parameters route as controller route name
 * id as record id
 * * CSRF_TOKEN in head.php
 */

function ajax_submit_update(route, id) {

    $('#edit').validate({
        submitHandler: function (form) {

            var myData = new FormData($("#edit")[0]);
            myData.append('_token', CSRF_TOKEN);

            swal({
                title: "Are you sure to submit?",
                text: "Submit Form",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Submit!"
            }, function () {

                $.ajax({
                    url: route + '/' + id,
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.type === 'success') {
                            $('#myModal').modal('hide');
                            swal("Done!", "It was succesfully done!", "success");
                            reload_table();
                        } else if (data.type === 'error') {
                            if (data.errors) {
                                $.each(data.errors, function (key, val) {
                                    $('#error_' + key).html(val);
                                });
                            }
                            $("#status").html(data.message);
                            swal("Error sending!", "Please fix the errors", "error");
                        }
                    }
                });
            });
        }
    });
}


/*
 * record delete function
 * parameters route as controller route name
 * id as record id
 * CSRF_TOKEN in head.php
 */

function ajax_submit_delete(route, id) {
    swal({
        title: "Are you sure?",
        text: "Deleted data cannot be recovered!!",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Delete"
    }, function () {
        $.ajax({
            url: route + '/' + id,
            type: 'DELETE',
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            "dataType": 'json',
            success: function (data) {
                if (data.type === 'success') {
                    swal("Done!", "Successfully Deleted", "success");
                    reload_table();
                } else if (data.type === 'danger') {
                    swal("Error deleting!", "Try again", "error");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Try again", "error");
            }
        });
    });
}
