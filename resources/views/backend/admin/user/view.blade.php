<div class="row">
    <div class="col-md-12 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover">
            <tbody>
            <tr>
                <td class="subject"> User Name</td>
                <td> :</td>
                <td> {{ $user->name }} </td>
            </tr>
            <tr>
                <td class="subject"> Email Address</td>
                <td> :</td>
                <td> {{ $user->email }} </td>
            </tr>
            <tr>
                <td class="subject">  Roles </td>
                <td> :</td>
                <td>
                    @if(!empty($roles))

                        @foreach($roles as $role)
                            <label class="badge badge-success">{{ $role }}</label>
                        @endforeach

                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>