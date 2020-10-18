<form id='edit' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div id="status"></div>
    {{method_field('PATCH')}}
    <div class="form-row">
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
            <strong>EIIN</strong>
            <input type="text" class="form-control" id="eiin" name="eiin" value="{{ $settings->eiin }}"
                   placeholder="" required>
            <span id="error_eiin" class="has-error"></span>
        </div>
        <div class="form-groupcol-xs-12 col-sm-12 col-md-3">
            <strong>PABX</strong>
            <input type="text" class="form-control" id="pabx" name="pabx" value="{{ $settings->pabx }}"
                   placeholder="">
            <span id="error_pabx" class="has-error"></span>
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
        <div class="clearfix"></div>
        <div class="form-group col-xs-12 col-sm-12 col-md-9">
            <strong>Address</strong>
            <input type="text" class="form-control" id="address" name="address" value="{{ $settings->address }}"
                   placeholder="" required>
            <span id="error_address" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-3">
            <strong>Website Layout</strong>
            <select name="layout" id="layout" class="form-control">
                <option value="{{ $settings->layout}}">{{ $settings->layout ? 'Fullwidth' : 'Boxed' }}</option>
                <option value="1">Fullwidth</option>
                <option value="0">Boxed</option>
            </select>
            <span id="error_layout" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <label for="logo">Logo (File must be jpg, jpeg, png)</label>
            <div class="input-group">
                <input id="logo" type="file" name="logo" style="display:none">
                <div class="input-group-prepend">
                    <a class="btn btn-secondary text-white" onclick="$('input[id=logo]').click();">Browse</a>
                </div>
                <input type="text" name="SelectedFileName" class="form-control" id="SelectedFileName"
                       value="{{$settings->logo}}" readonly>
            </div>
            <script type="text/javascript">
                $('input[id=logo]').change(function () {
                    $('#SelectedFileName').val($(this).val());
                });
            </script>
            <span id="error_logo" class="has-error"></span>
        </div>
        <div class="col-md-6">
            <label for="favicon">Logo (File must be jpg, jpeg, png)</label>
            <div class="input-group">
                <input id="favicon" type="file" name="favicon" style="display:none">
                <div class="input-group-prepend">
                    <a class="btn btn-secondary text-white" onclick="$('input[id=favicon]').click();">Browse</a>
                </div>
                <input type="text" name="SelectedFavicon" class="form-control" id="SelectedFavicon"
                       value="{{$settings->favicon}}" readonly>
            </div>
            <script type="text/javascript">
                $('input[id=favicon]').change(function () {
                    $('#SelectedFileName').val($(this).val());
                });
            </script>
            <span id="error_favicon" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-xs-12 col-sm-12 col-md-4">
            <strong>Facebook:</strong>
            <input type="text" class="form-control" id="social_facebook" name="social_facebook"
                   value="{{ $settings->social_facebook }}"
                   placeholder="">
            <span id="error_social_facebook" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-4">
            <strong>Twitter:</strong>
            <input type="text" class="form-control" id="social_twitter" name="social_twitter"
                   value="{{ $settings->social_twitter }}"
                   placeholder="">
            <span id="error_social_twitter" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-4">
            <strong>Linkedin:</strong>
            <input type="text" class="form-control" id="social_linkedin" name="social_linkedin"
                   value="{{ $settings->social_linkedin }}"
                   placeholder="">
            <span id="error_social_linkedin" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-xs-12 col-sm-12 col-md-6">
            <strong>GooglePlus:</strong>
            <input type="text" class="form-control" id="social_google" name="social_google"
                   value="{{ $settings->social_google }}"
                   placeholder="">
            <span id="error_social_google" class="has-error"></span>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-6">
            <strong>Youtube:</strong>
            <input type="text" class="form-control" id="social_youtube" name="social_youtube"
                   value="{{ $settings->social_youtube }}"
                   placeholder="">
            <span id="error_social_social_youtube" class="has-error"></span>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12">
            <strong>Google Maps</strong>
            <textarea type="text" class="form-control" id="maps" name="maps"
                      placeholder="">{{ $settings->maps }}</textarea>
            <span id="error_maps" class="has-error"></span>
            <p class="help-block">Google maps Iframe code here</p>
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
    $('.button-submit').click(function () {
        // route name and record id
        ajax_submit_update('settings', "{{ $settings->id }}")
    });
</script>
