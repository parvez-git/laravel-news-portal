@extends('frontend.layout.master')

@section('title', 'Single News')

@section('content')

    <section class="section">
        <div class="page-header container">
            <ul class="border-vertical">
                <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
                <li> / </li>
                <li><a href="{{ route('page.category',$newssingle->category->slug) }}"><i class="far fa-folder"></i> {{ $newssingle->category->name }}</a></li>
                <li> / </li>
                <li>{{ $newssingle->title }}</li>
            </ul>
        </div>
    </section>

    <section class="section">
        <div class="section-news container">

            <div class="news">
                <div class="news-single">

                    <div class="section-item">
                        <img src="{{ asset('images/'.$newssingle->image) }}" alt="{{ $newssingle->title }}" class="width-100">

                        <h1>{{ $newssingle->title }}</h1>

                        <p>{{ $newssingle->details }}</p>

                        <ul>
                            <li><a href="{{ route('page.category',$newssingle->category->slug) }}"><i class="far fa-folder"></i> {{ $newssingle->category->name }}</a></li>
                            <li><i class="far fa-clock"></i> {{ $newssingle->created_at->diffForHumans() }}</li>
                            <li><i class="far fa-comment-alt"></i> {{ $newssingle->id }}</li>
                        </ul>
                    </div>

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