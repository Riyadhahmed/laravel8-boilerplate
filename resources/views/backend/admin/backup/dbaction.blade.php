<a class="btn btn-xs btn-info mr-1" data-toggle='tooltip' title='Download'
   href="{{ URL :: to('admin/backups/download/'.$file_name) }}"><i class="fa fa-download"></i></a>
<a class="btn btn-xs btn-danger delete" data-button-type="delete" data-toggle='tooltip' title='Delete'
   id="{{$file_name}}"><i class="fa fa-trash"></i> </a>