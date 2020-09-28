@extends('backend.layouts.master')
@section('title', ' All Backups')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-albums icon-gradient bg-mean-fruit"> </i>
                </div>
                <div>All Backup</div>
                <div class="d-inline-block ml-2">
                    <button class="btn btn-success" onclick="create('db_backup')"><i
                            class="glyphicon glyphicon-plus"></i>
                        Database Backup
                    </button>
                    <button class="btn btn-success" onclick="create('full_backup')"><i
                            class="glyphicon glyphicon-plus"></i>
                        Full Backup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="manage_all" class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Size</th>
                                <th>Created At</th>
                                <th>Duration</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                "order": [[4, "desc"]],
                ajax: '/admin/allBackups',
                columns: [
                    {data: 'file_name', name: 'file_name'},
                    {data: 'file_size', name: 'file_size'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'time_elapsed', name: 'time_elapsed'},
                    {data: 'time', name: 'time', visible: false},
                    {data: 'action', name: 'action'}
                ]
            });
        });
    </script>
    <script type="text/javascript">

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax
        }


        function create(val) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: "Are you sure?",
                text: "Please wait untill backup response reply!",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Backup",
                cancelButtonText: "Cancel"
            }, function () {
                $.ajax({
                    url: 'backups/' + val,
                    data: {"_token": CSRF_TOKEN},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {

                        if (data.type === 'success') {

                            swal("Done!", data.message, "success");
                            reload_table();

                        } else if (data.type === 'danger') {

                            swal("Error!", data.message, "error");

                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error!", data.message, "error");
                    }
                });
            });

        }

    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#manage_all").on("click", ".delete", function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var id = $(this).attr('id');
                swal({
                    title: "Are you sure",
                    text: "Deleted data cannot be recovered!!",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel"
                }, function () {
                    $.ajax({
                        url: 'backups/delete/' + id,
                        data: {"_token": CSRF_TOKEN},
                        type: 'DELETE',
                        dataType: 'json',
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
            });
        });

    </script>
@stop