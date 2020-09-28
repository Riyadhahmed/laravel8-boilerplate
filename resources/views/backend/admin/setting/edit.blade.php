<form id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div id="status"></div>
    <div class="form-row">
        {{method_field('PATCH')}}
        <div class="form-group col-xs-12 col-sm-12 col-md-6">
            <strong>Name</strong>
            <input type="text" class="form-control" id="name" name="name" value="{{ $settings->name }}"
                   placeholder="" required>
            <span id="error_name" class="has-error"></span>
        </div>
        <div class="form-groupcol-xs-12 col-sm-12 col-md-6">
            <strong>Slogan</strong>
            <input type="text" class="form-control" id="slogan" name="slogan" value="{{ $settings->slogan }}"
                   placeholder="">
            <span id="error_slogan" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-xs-12 col-sm-12 col-md-3">
            <strong>Contact</strong>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ $settings->contact }}"
                   placeholder="">
            <span id="error_contact" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-3">
            <strong>Email:</strong>
            <input type="text" class="form-control" id="email" name="email" value="{{ $settings->email }}"
                   placeholder="">
            <span id="error_email" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-3">
            <strong>Registration:</strong>
            <input type="text" class="form-control" id="reg" name="reg" value="{{ $settings->reg }}"
                   placeholder="">
            <span id="error_reg" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-3">
            <strong>Stablished Year:</strong>
            <input type="text" class="form-control" id="stablished" name="stablished"
                   value="{{ $settings->stablished }}"
                   placeholder="">
            <span id="error_stablished" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-xs-12 col-sm-12 col-md-5">
            <strong>Address</strong>
            <input type="text" class="form-control" id="address" name="address" value="{{ $settings->address }}"
                   placeholder="" required>
            <span id="error_address" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-2">
            <strong>Running Session</strong>
            <select name="running_year" class="form-control">
                <option value="">Running Session</option>
                @for($i = 0; $i < 10; $i++)
                    <option value="{{ 2018+$i }}-{{ 2018+$i+1 }}"
                    @if($app_settings->running_year == (2018+$i).'-'.(2018+$i+1)) {{ 'selected' }} @endif>
                        {{ 2018+$i }}-{{ 2018+$i+1 }}
                    </option>
                @endfor
            </select><span id="error_address" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-3">
            <strong>Website:</strong>
            <input type="text" class="form-control" id="website" name="website" value="{{ $settings->website }}"
                   placeholder="" required>
            <span id="error_stablished" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-2">
            <strong>Website Layout</strong>
            <select name="layout" id="layout" class="form-control">
                <option value="{{ $settings->layout}}">{{ $settings->layout ? 'Fullwidth' : 'Boxed' }}</option>
                <option value="1">Fullwidth</option>
                <option value="0">Boxed</option>
            </select>
            <span id="error_layout" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <label for="logo">Upload Image</label>
            <input id="logo" type="file" name="logo" style="display:none">
            <div class="input-group">
                <div class="input-group-btn">
                    <a class="btn btn-success" onclick="$('input[id=logo]').click();">Browse</a>
                </div>
                <input type="text" name="SelectedFileName" class="form-control" id="SelectedFileName"
                       value="{{$settings->logo}}" readonly>
            </div>
            <div style="clear:both;"></div>
            <p class="help-block">File Extention must be jpg, jpeg, png. </p>
            <span id="error_photo" class="has-error"></span>
            <script type="text/javascript">
                $('input[id=logo]').change(function () {
                    $('#SelectedFileName').val($(this).val());
                });
            </script>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success button-submit"
                    data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
            </button>
        </div>
    </div>
</form>

<script>
    $("#layout option").val(function (idx, val) {
        $(this).siblings("[value='" + this.value + "']").remove();
        return val;
    });
    $(document).ready(function () {
        $('#loader').hide();
        $('#edit').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                name: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                name: {
                    required: 'Please enter name'
                }

            },
            submitHandler: function (form) {

                var myData = new FormData($("#edit")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'settings/' + '{{ $settings->id }}',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                        $("#submit").prop('disabled', true); // disable button
                    },
                    success: function (data) {

                        if (data.type === 'success') {
                            swal("Done!", "It was succesfully done!", "success");
                            reload_table();
                            notify_view(data.type, data.message);
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button
                            $("html, body").animate({scrollTop: 0}, "slow");
                            $('#myModal').modal('hide'); // hide bootstrap modal

                        } else if (data.type === 'error') {
                            if (data.errors) {
                                $.each(data.errors, function (key, val) {
                                    $('#error_' + key).html(val);
                                });
                            }
                            $("#status").html(data.message);
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button
                            swal("Error sending!", "Please try again", "error");

                        }

                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>