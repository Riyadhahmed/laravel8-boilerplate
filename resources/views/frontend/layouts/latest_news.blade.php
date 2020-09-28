<!-- latest_news section -->
@if($latest_news)
    <section class="blog-section spad">
        <div class="row">
            <div class="col-md-12 col-sm-12 section-title text-center">
                <h3>LATEST NEWS</h3>
                <p>All Recent News</p>
            </div>
            @foreach($latest_news as $news)
                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <img src="{{ asset($news->file_path) }}"
                             alt="Card image cap" class="card-img-top" width="50px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $news->title }}</h5>
                            <a class="btn btn-success" href="{{ URL :: to('/viewNews/'.$news->id) }}">
                                <h6>View Details</h6></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
<!-- latest_news section -->