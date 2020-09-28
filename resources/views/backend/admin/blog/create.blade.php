<form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
      novalidate>
    <div class="clearfix"></div>
    <div class="form-row">
        <div id="status"></div>
        <div class="form-group col-md-12 col-sm-12">
            <label for=""> Title </label>
            <input type="text" class="form-control" id="title" name="title" value=""
                   placeholder="" required>
            <span id="error_title" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12 col-sm-12">
            <label for=""> Description </label>
            <textarea type="text" class="form-control" id="description" name="description" value=""
                      placeholder=""></textarea>
            <span id="error_description" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4 col-sm-12">
            <label for=""> Category </label>
            <select name="category" id="category" class="form-control" required>
                <option value="Notice Board">Notice Board</option>
                <option value="Latest News">Latest News</option>
                <option value="Job News">Job News</option>
            </select>
            <span id="error_category" class="has-error"></span>
        </div>
        <div class="col-md-8">
            <label for="photo">Upload Image</label>
            <input id="photo" type="file" name="photo" style="display:none">
            <div class="input-group">
                <div class="input-group-btn">
                    <a class="btn btn-success" onclick="$('input[id=photo]').click();">Browse</a>
                </div><!-- /btn-group -->
                <input type="text" name="SelectedFileName" class="form-control" id="SelectedFileName"
                       value="" readonly>
            </div>
            <div class="clearfix"></div>
            <p class="help-block">File must be jpg, jpeg, png. width below 1500px and heigth 700px and less than 2mb</p>
            <script type="text/javascript">
                $('input[id=photo]').change(function () {
                    $('#SelectedFileName').val($(this).val());
                });
            </script>
            <span id="error_photo" class="has-error"></span>
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
    $(document).ready(function () {

        $('.filter').select2();
        $('#loader').hide();

        $('#create').validate({// <- attach '.validate()' to your form
            // Rules for form validation
            rules: {
                title: {
                    required: true
                },
                category: {
                    required: true
                }
            },
            // Messages for form validation
            messages: {
                name: {
                    required: 'Enter slider name'
                }
            },
            submitHandler: function (form) {

                var myData = new FormData($("#create")[0]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url: 'news',
                    type: 'POST',
                    data: myData,
                    dataType: 'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                        $(".button-submit").prop('disabled', false); // disable button
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            reload_table();
                            $('#loader').hide();
                            $(".button-submit").prop('disabled', false); // disable button
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
                            $(".button-submit").prop('disabled', false); // disable button

                        }
                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>