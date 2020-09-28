<div class="row">
    <div class="col-md-12 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover">
            <tbody>
            <tr>
                <td class="subject"> Division Name</td>
                <td> :</td>
                <td> {{ $division->division_name }} </td>
            </tr>
            <tr>
                <td class="subject"> Division Area</td>
                <td> :</td>
                <td> {{ $division->division_area }} </td>
            </tr>
            <tr>
                <td class="subject"> Division Address</td>
                <td> :</td>
                <td> {{ $division->division_address }} </td>
            </tr>
            <tr>
                <td class="subject"> Status</td>
                <td> :</td>
                <td> @php $status = $division->status ? 'Active' : 'Inactive' ;  @endphp {{ $status }} </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>