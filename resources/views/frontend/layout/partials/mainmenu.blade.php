<div class="header-menu-container">
    <div class="container">
        <div class="header-menu">
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>

                    @if(isset($mainmenus[0]))
                        @foreach($mainmenus[0] as $mainmenu)
                        <li>
                            <a href="{{ $mainmenu->menu_url }}">{{ $mainmenu->name }}</a>
                            
                            @if(isset($mainmenus[$mainmenu->id]))
                                <i class="fas fa-angle-down"></i>
                                <ul>
                                    @foreach($mainmenus[$mainmenu->id] as $mainmenu)
                                        <li>
                                            <a href="{{ $mainmenu->menu_url }}">{{ $mainmenu->name }}</a> 
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endforeach
                    @endif

                    <li>
                        <a href="javascript:void(0)"><i class="fas fa-ellipsis-v"></i></a>
                        @if(isset($mainmenus[10000]))
                            <ul>
                                @foreach($mainmenus[10000] as $mainmenu)
                                    <li>
                                        <a href="{{ $mainmenu->menu_url }}">{{ $mainmenu->name }}</a> 
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
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