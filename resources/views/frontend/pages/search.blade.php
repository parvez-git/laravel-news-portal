@extends('frontend.layout.master')

@section('title', 'Search Page')

@section('content')

    <section class="section">
        <div class="page-header container">
            <h1>Search result for: @if(isset($_GET['search'])) {{ $_GET['search'] }} @endif</h1>
            <ul>
                <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
            </ul>
        </div>
    </section>

    <section class="section">
        <div class="section-news container">

            <div class="news">
                <div class="news-lifestyle">
                    @forelse($newssearch as $news)
                        <div class="section-item">

                            <a href="{{ route('page.news',$news->slug) }}" class="bg-image" style="background-image:url({{ asset('images/'.$news->image) }})"></a>
                            
                            <div>
                                <h3><a href="{{ route('page.news',$news->slug) }}">{{ $news->title }}</a></h3>

                                <p>{{ $news->details }}</p>

                                <ul>
                                    <li><i class="far fa-folder"></i> <a href="{{ route('page.category',$news->category->slug) }}">{{ $news->category->name }}</a></li>
                                    <li><i class="far fa-clock"></i> {{ $news->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                        </div>
                    @empty 
                        <h2>No result found!</h2>
                    @endforelse
                </div>
            </div>

            <aside class="sidebar">
                @include('frontend.pages.sidebar')
            </aside>

        </div>
    </section>

@endsection

@push('scripts')

@endpush