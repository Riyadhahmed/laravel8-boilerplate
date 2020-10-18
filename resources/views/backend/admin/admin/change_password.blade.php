@extends('backend.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit"> </i>
                </div>
                <div>Change Password</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div id="status"></div>
                        {{method_field('PATCH')}}
                        <div class="form-group col-md-6 col-sm-12">
                            <label for=""> New Password </label>
                            <input type="password" class="form-control" id="password" name="password" value=""
                                   placeholder="Type New Password" required>
                            <span id="error_name" class="has-error"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success" id="submit"><span
                                    class="fa fa-save fa-fw"></span> Save
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function () {

            $('#loader').hide();

            $('#edit').validate({
                submitHandler: function (form) {

                    var myData = new FormData($("#edit")[0]);
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
                            url: 'change_password',
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
                // <- end 'submitHandler' callback
            });                    // <- end '.validate()'

        });
    </script>
@endsection
