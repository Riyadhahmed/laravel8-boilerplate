<!-- widget -->
@php
    $notices = \App\Models\News::where('category', 'Notice Board')->orderby('created_at', 'desc')->take(5)->get();
@endphp
<div class="widget">
    @if($notices)
        <h5 class="widget-title">Notice Board</h5>
        <div class="recent-post-widget">
            @foreach($notices as $notice)
                <div class="rp-item">
                    <img class="rp-thumb set-bg" src="{{ asset($notice->file_path) }}"/>
                    <div class="rp-content">
                        <a href="{{ URL :: to('/viewNews/'.$notice->id) }}">
                            <h6>{{ $notice->title }}</h6></a>
                        <p><i class="fa fa-clock-o"></i> {{ $notice->created_at }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>