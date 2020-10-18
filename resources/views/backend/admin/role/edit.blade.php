{!! Form::model($role, ['method' => 'PATCH','id'=>'edit']) !!}
<div class="form-row">
    <div id="status"></div>
    <div class="form-group col-md-12 col-sm-12">
        <label for=""> Role Name </label>
        <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}"
               placeholder="" required>
        <span id="error_name" class="has-error"></span>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-12 col-md-12">
        <strong>Assign Permissions: </strong>
        <div class='row mb-3 mt-3'>
            @foreach($permissions as $permission)
                @if($permission->guard_name != 'admin')
                    <div class="col-md-3 col-sm-12 mb-1">
                        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions, array('class'=>'data-check flat-green')) }}
                        {{Form::label($permission->name, $permission->name, array('class'=>'')) }}
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-md-12 mb-3 mt-3">
        <button type="submit" class="btn btn-success"><span class="fa fa-save fa-fw"></span> Save</button>
    </div>
</div>

{{ Form::close() }}

<script>
    $(document).ready(function () {

        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green',
        });

        $('#edit').validate({
            submitHandler: function (form) {

                var list_id = [];
                $(".data-check:checked").each(function () {
                    list_id.push(this.value);
                });
                if (list_id.length > 0) {

                    var myData = new FormData($("#edit")[0]);
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    myData.append('_token', CSRF_TOKEN);

                    swal({
                        title: "Confirm to assign " + list_id.length + " permissions",
                        text: "Assign permission with that role!",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, Assign!"
                    }, function () {

                        $.ajax({
                            url: 'roles/' + '{{ $role->id }}',
                            type: 'POST',
                            data: myData,
                            dataType: 'json',
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function (data) {

                                if (data.type === 'success') {
                                    swal("Done!", "It was succesfully done!", "success");
                                    reload_table();
                                    notify_view(data.type, data.message);
                                    $('#myModal').modal('hide');

                                } else if (data.type === 'error') {
                                    if (data.errors) {
                                        $.each(data.errors, function (key, val) {
                                            $('#error_' + key).html(val);
                                        });
                                    }
                                    $("#status").html(data.message);
                                    swal("Error sending!", "Please try again", "error");
                                }
                            }
                        });
                    });
                }
                else {
                    swal("", "No Permission Have Selected!", "warning");
                }
            }
        });
    });
</script>