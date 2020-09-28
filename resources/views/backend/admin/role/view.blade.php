<div class="row">
    <div class="col-md-12 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover">
            <tbody>
            <tr>
                <td class="subject"> Role Name</td>
                <td> :</td>
                <td> {{ $role->name }} </td>
            </tr>
            <tr>
                <td class="subject"> Guard Name</td>
                <td> :</td>
                <td> {{ $role->guard_name }} </td>
            </tr>
            <tr>
                <td class="subject"> Assigned Permissions</td>
                <td> :</td>
                <td>
                    @if($role->name === 'admin') {{ 'Admin have all permissions by default' }} @endif
                    @php $no= 1; @endphp
                    @foreach($permissions as $permission)
                        <span class="col-md-4">
                           {{ $no++ . ') ' }} {{ $permission->name }}
                      </span>
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>