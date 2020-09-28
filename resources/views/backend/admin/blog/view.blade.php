<div class="row">
    <div class="col-md-12 col-sm-12 table-responsive">
        <table id="view_details" class="table table-bordered table-hover">
            <tbody>
            <tr>
                <td> Title</td>
                <td> :</td>
                <td> {{ $news->title }} </td>
            </tr>
            <tr>
                <td> Description</td>
                <td> :</td>
                <td> {{ $news->description }} </td>
            </tr>
            <tr>
                <td> Category</td>
                <td> :</td>
                <td> {{ $news->category }} </td>
            </tr>
            <tr>
                <td> Author</td>
                <td> :</td>
                <td> {{ $news->author ? $news->author->name : '' }} </td>
            </tr>
            <tr>
                <td> Status</td>
                <td> :</td>
                <td> @php $status = $news->status ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' ;  @endphp {!! $status !!}   </td>
            </tr>
            <tr>
                <td> Image</td>
                <td> :</td>
                <td><img src="{{ asset($news->file_path) }}" class="img-responsive img-thumbnail"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>