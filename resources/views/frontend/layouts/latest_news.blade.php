<!-- latest_news section -->
@if($latest_news)
    <section class="blog-section spad">
        <div class="row">
            <div class="col-md-12 col-sm-12 section-title text-center">
                <h3>LATEST NEWS</h3>
                <p>All Recent News</p>
            </div>
            <div class="col-md-12 col-sm-12">
                @foreach($latest_news as $news)
                    <div class="col-md-12">
                        <div class="blog-item">
                            <div class="blog-thumb set-bg" data-setbg="{{ asset($news->file_path) }}"></div>
                            <div class="blog-content">
                                <a href="{{ URL :: to('/viewNews/'.$news->id) }}">
                                    <h4>{{ $news->title }}</h4></a>
                                <div class="blog-meta">
                                    <span><i class="fa fa-calendar-o"></i> {{ $news->created_at }}</span>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
<!-- latest_news section -->