@extends('frontend.layouts.master')
@section('title', 'View Details')
@section('content')
    <section class="blog-page-section">
        @if($blog)
            <div class="col-md-12">
                <div class="post-item post-details">
                    <img src="{{ asset($blog->file_path) }}" class="post-thumb-full img-responsive"
                         alt="{{ $blog->title }}">
                    <div class="post-content">
                        <h3>{{ $blog->title }}</h3>
                        <div class="post-meta">
                            <span><i class="fa fa-calendar-o"></i> {{ $blog->created_at }}</span>
                        </div>
                        <p class="news_details">{{ $blog->description }} </p>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                Sorry Nothing found!!!
            </div>
        @endif
    </section>
@endsection