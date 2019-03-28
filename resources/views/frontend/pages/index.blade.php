@extends('frontend.layout.master')

@section('title', 'Archive Page')

@section('content')

    <section class="section">
        <div class="page-header container">
            <ul class="border-vertical">
                <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
                <li> / </li>
                <li> Archive</li>
            </ul>
        </div>
    </section>

    <section class="section">
        <div class="section-archive container">

            <div class="archive-news">
                @foreach($newsarchives as $category)

                <div class="news-item">
                    <h2>{{ $category->name }}</h2>
                    
                    @foreach($category->newslist as $news)

                        <a href="{{ route('page.news',$news->slug) }}">{{ $news->title }}</a>
   
                    @endforeach
                </div>

                @endforeach
            </div>

        </div>
    </section>

@endsection

@push('scripts')

@endpush