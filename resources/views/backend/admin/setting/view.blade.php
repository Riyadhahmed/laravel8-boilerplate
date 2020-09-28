<div class="row">
    <div class="col-md-8 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover table-condensed table-striped">
            <tbody>
            <tr>
                <td class="subject"> Name</td>
                <td> :</td>
                <td> {{ $settings->name }} </td>
            </tr>
            <tr>
                <td class="subject"> Slogan</td>
                <td> :</td>
                <td> {{ $settings->slogan }} </td>
            </tr>
            <tr>
                <td class="subject"> Registration No</td>
                <td> :</td>
                <td> {{ $settings->reg }} </td>
            </tr>
            <tr>
                <td class="subject"> Stablished Year</td>
                <td> :</td>
                <td> {{ $settings->stablished }} </td>
            </tr>
            <tr>
                <td class="subject"> Email</td>
                <td> :</td>
                <td> {{ $settings->email }} </td>
            </tr>
            <tr>
                <td class="subject"> Contact</td>
                <td> :</td>
                <td> {{ $settings->contact }} </td>
            </tr>
            <tr>
                <td class="subject"> Address</td>
                <td> :</td>
                <td> {{ $settings->address }} </td>
            </tr>
            <tr>
                <td class="subject"> Website layout</td>
                <td> :</td>
                <td> {{ $settings->layout ? 'Fullwidth' : 'Boxed' }} </td>
            </tr>
            <tr>
                <td class="subject"> Running Year</td>
                <td> :</td>
                <td> {{ $settings->running_year }} </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <img src="{{ asset($settings->logo) }}" class="img-responsive img-circle" width="150px"/><br/><br/>
        Registration : {{ $settings->reg  }} <br/>
        Stablished : {{ $settings->stablished  }} <br/>
        Email : {{ $settings->email  }} <br/>
        Web : {{ $settings->website  }} <br/>
    </div>
</div>