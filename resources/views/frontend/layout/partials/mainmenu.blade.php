<div class="header-menu-container">
    <div class="container">
        <div class="header-menu">
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>

                    @foreach($mainmenus as $mainmenu)
                        <li><a href="{{ $mainmenu->menu_url }}">{{ $mainmenu->name }}</a></li>
                    @endforeach

                    <li><a href="#"><i class="fas fa-ellipsis-v"></i></a></li>
                </ul>
            </nav>
            <div class="search">
                <form action="{{ route('page.search') }}" method="GET">
                    <input id="searchinput" type="text" name="search" placeholder="SEARCH">
                    <button class="search-btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>