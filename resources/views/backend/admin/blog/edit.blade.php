<form id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div id="status"></div>
    {{method_field('PATCH')}}
    <div class="form-row">
        <div class="form-group col-md-9 col-sm-12">
            <label for=""> Title </label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}"
                   placeholder="" required>
            <span id="error_title" class="has-error"></span>
        </div>
        <div class="form-group col-md-3 col-sm-12">
            <label for=""> Category </label>
            <select name="category" id="category" class="form-control" required>
                <option value="{{ $blog->category }}">{{ $blog->category }}</option>
                <option value="Notice Board">Notice Board</option>
                <option value="Latest News">Latest News</option>
                <option value="Job News">Job News</option>
            </select>
            <span id="error_category" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12 col-sm-12">
            <label for=""> Description </label>
            <textarea type="text" class="form-control" id="description" name="description"
                      placeholder="">{{ $blog->description }}</textarea>
            <span id="error_description" class="has-error"></span>
        </div>
        <div class="form-group col-md-4">
            <label for=""> Status </label><br/>
            <input type="radio" name="status" class="flat-green"
                   value="1" {{ ( $blog->status == 1 ) ? 'checked' : '' }} /> Active
            <input type="radio" name="status" class="flat-green"
                   value="0" {{ ( $blog->status == 0 ) ? 'checked' : '' }}/> In Active
        </div>
        <div class="col-md-8">
            <label for="photo">Logo (File must be jpg, jpeg, png)</label>
            <div class="input-group">
                <input id="photo" type="file" name="photo" style="display:none">
                <div class="input-group-prepend">
                    <a class="btn btn-secondary text-white" onclick="$('input[id=photo]').click();">Browse</a>
                </div>
                <input type="text" name="SelectedFileName" class="form-control" id="SelectedFileName"
                       value="{{$blog->file_path}}" readonly>
            </div>
            <script type="text/javascript">
                $('input[id=photo]').change(function () {
                    $('#SelectedFileName').val($(this).val());
                });
            </script>
            <span id="error_photo" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-12 mb-3 mt-3">
            <button type="submit" class="btn btn-success button-submit"
                    data-loading-text="Loading..."><span class="fa fa-save fa-fw"></span> Save
            </button>
        </div>
    </div>
</form>
<script>
    $('input[type="radio"].flat-green').iCheck({
        radioClass: 'iradio_flat-green'
    });
    $('.button-submit').click(function () {
        // route name and record id
        ajax_submit_update('blogs', "{{ $blog->id }}")
    });
</script>