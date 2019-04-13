<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/breaking-news-ticker.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>
<body>
    
    <header>

        @include('frontend.layout.partials.header')

        @include('frontend.layout.partials.mainmenu')
            
    </header>

    @yield('content')

    <footer>

        @include('frontend.layout.partials.footer')

    </footer>

    <!-- jQuery 3 -->
    <script src="{{ asset('backend/components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/breaking-news-ticker.min.js') }}"></script>

    @stack('scripts')

    <script>
        $(function(){
            $('#breakingnewsticker').breakingNews({radius: 0});
        });
    </script>
    
</body>
</html>