<div class="header-top-area">
    <div class="container">
        <div class="header-top">
            <div class="info">
                <ul>
                    @php 
                        $timezone = 'Asia/Dhaka';
                        date_default_timezone_set($timezone);
                    @endphp
                    <li><span>{{ date('h:i A') }} - {{ date('d M Y') }}</span></li>

                    @guest
                        <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a></li>
                        <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Sign in</a></li>
                        @else
                        <li><a href="{{ route('profile') }}"><i class="fas fa-user-alt"></i> {{ auth()->user()->name }}</a></li>
                        <li><a href="{{ route('login') }}" onclick="event.preventDefault(); document.getElementById('logout-form-front').submit();"><i class="fas fa-sign-in-alt"></i> Logout</a></li>
                        <form id="logout-form-front" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest

                </ul>
            </div>

            @if(isset($newstickers) && count($newstickers) > 0) 
                <div class="breaking-news-ticker" id="breakingnewsticker">
                    <div class="bn-label">Breaking News</div>
                    <div class="bn-news">
                        <ul>
                            @foreach ($newstickers as $key => $news)
                                <li><a href="{{ route('page.news',$news->slug) }}">{{ ++$key}}. {{ $news->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="bn-controls">
                        <button><span class="bn-arrow bn-prev"></span></button>
                        <button><span class="bn-action"></span></button>
                        <button><span class="bn-arrow bn-next"></span></button>
                    </div>
                </div>
            @endif

            <div class="socials">
                <ul>
                    @if(isset($headersettings) && $headersettings['facebook'])
                        <li><a href="{{ $headersettings['facebook'] }}" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                    @endif
                    @if(isset($headersettings) && $headersettings['twitter'])
                        <li><a href="{{ $headersettings['twitter'] }}" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                    @endif
                    @if(isset($headersettings) && $headersettings['linkedin'])
                        <li><a href="{{ $headersettings['linkedin'] }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                    @endif
                    @if(isset($headersettings) && $headersettings['youtube'])
                        <li><a href="{{ $headersettings['youtube'] }}" target="_blank"><i class="fab fa-youtube-square"></i></a></li>
                    @endif
                    @if(isset($headersettings) && $headersettings['vimeo'])
                        <li><a href="{{ $headersettings['vimeo'] }}" target="_blank"><i class="fab fa-vimeo-square"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="header-logo">
        <div class="logo">
            <a href="{{ route('home') }}">
                @if(isset($headersettings) && $headersettings['site_logo'])
                    <img src="{{ asset('images/'.$headersettings['site_logo']) }}" alt="Logo">
                @elseif(isset($headersettings) && $headersettings['site_name'])
                    {{ $headersettings['site_name'] }}
                @else
                    NEWS PORTAL
                @endif
            </a>
        </div>
        <div class="ads">
            @foreach ($headerads as $item)
                @if (request()->is('/') && $item->type == 'home')
                    <img src="{{ asset('images/advertisements/'.$item->header_top) }}" alt="Ads" class="width-100">
                @elseif ($item->type == 'category')
                    @if(request()->path() == 'page/category/'.$item->slug)
                        <img src="{{ asset('images/advertisements/'.$item->header_top) }}" alt="Ads" class="width-100">
                    @endif
                @endif
                
            @endforeach
        </div>
    </div>
</div>