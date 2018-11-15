<div class="sidebar-item">
    <div class="tabs-container">
        <div class="tabs">
            <div data-target="#panel-one" class="tab active">Popular</div>
            <div data-target="#panel-two" class="tab">Recent</div>
            <div data-target="#panel-three" class="tab">Discussed</div>
        </div>
        <div class="panel active" id="panel-one">
            @foreach($newstabspopular as $popular)
                <div class="section-item">
                    <h3><a href="{{ route('page.news',$popular->slug) }}">{{ $popular->title }}</a></h3>
                    <ul>
                        <li><i class="far fa-folder"></i> <a href="{{ route('page.category',$popular->category->slug) }}">{{ $popular->category->name }}</a></li>
                        <li><i class="far fa-clock"></i> {{ $popular->created_at->diffForHumans() }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="panel" id="panel-two">
            @foreach($newstabsrecent as $recent)
                <div class="section-item">
                    <h3><a href="{{ route('page.news',$recent->slug) }}">{{ $recent->title }}</a></h3>
                    <ul>
                        <li><i class="far fa-folder"></i> <a href="{{ route('page.category',$recent->category->slug) }}">{{ $recent->category->name }}</a></li>
                        <li><i class="far fa-clock"></i> {{ $recent->created_at->diffForHumans() }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="panel" id="panel-three">
            @foreach($newscategory_two as $topnews)
                <div class="section-item">
                    <h3><a href="">{{ $topnews->title }}</a></h3>
                    <ul>
                        <li><i class="far fa-folder"></i> <a href="{{ route('page.category',$topnews->category->slug) }}">{{ $topnews->category->name }}</a></li>
                        <li><i class="far fa-clock"></i> {{ $topnews->created_at->diffForHumans() }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="sidebar-item">
    <div class="sidebar-news category-news">
        <h2>Category List</h2>
        @foreach($newscategory_list as $newscategory)
            <div class="section-item">
                <h3>
                    <i class="far fa-arrow-alt-circle-right"></i>
                    <a href="{{ route('page.category',$newscategory->slug) }}">{{ $newscategory->name }}</a>
                    <span>({{ $newscategory->newslist_count }})</span>
                </h3>
            </div>
        @endforeach
    </div>
</div>

<div class="sidebar-item">
    <div class="sidebar-news news-with-image">
        <h2>Sidebar News Image</h2>
        @foreach($newscategory_two as $topnews)
            <div class="section-item">
                <div class="section-item-news">
                    <a href="#">
                        <img src="{{ asset('images/'.$newsinRandomOrder->image) }}" alt="{{ $newsinRandomOrder->title }}" class="width-100">
                    </a>
                    <h3><a href="">{{ $topnews->title }}</a></h3>
                </div>
                <ul>
                    <li><i class="far fa-folder"></i> <a href="{{ route('page.category',$topnews->category->slug) }}">{{ $topnews->category->name }}</a></li>
                    <li><i class="far fa-clock"></i> {{ $topnews->created_at->diffForHumans() }}</li>
                </ul>
            </div>
        @endforeach
    </div>
</div>

<div class="sidebar-item">
    <div class="sidebar-news">
        <h2>Sidebar News</h2>
        @foreach($newscategory_two as $topnews)
            <div class="section-item">
                <h3><a href="">{{ $topnews->title }}</a></h3>
                <ul>
                    <li><i class="far fa-folder"></i> <a href="{{ route('page.category',$topnews->category->slug) }}">{{ $topnews->category->name }}</a></li>
                    <li><i class="far fa-clock"></i> {{ $topnews->created_at->diffForHumans() }}</li>
                </ul>
            </div>
        @endforeach
    </div>
</div>

<div class="sidebar-item">
    <div class="sidebar-news">
        <h2>Random News</h2>
        @if($newsinRandomOrder)
        <div class="section-item">
            <a href="#">
                <img src="{{ asset('images/'.$newsinRandomOrder->image) }}" alt="{{ $newsinRandomOrder->title }}" class="width-100">
            </a>
            <h3><a href="">{{ $newsinRandomOrder->title }}</a></h3>
            <p>{{ $newsinRandomOrder->details }}</p>
            <ul>
                <li><i class="far fa-folder"></i> <a href="{{ route('page.category',@$newsinRandomOrder->category->slug) }}">{{ @$newsinRandomOrder->category->name }}</a></li>
                <li><i class="far fa-clock"></i> {{ $newsinRandomOrder->created_at->diffForHumans() }}</li>
            </ul>
        </div>
        @endif
    </div>
</div>


@push('scripts')
    <script>
        $(function(){

            const tabs = document.querySelector('.tabs');
            const panels = document.querySelectorAll('.panel');
            tabs.addEventListener('click', function(e){
                if(e.target.tagName == 'DIV'){
                    const targetPanel = document.querySelector(e.target.dataset.target);
                    panels.forEach(function(panel){
                        if(panel == targetPanel){
                            panel.classList.add('active');
                            targetPanel.classList.add('active');
                        }else{
                            panel.classList.remove('active');
                        }
                    });
                }
            });
            
            $('.tabs > .tab').on('click', function(e){
                $('.tab').removeClass('active');
                $(this).addClass('active');
            });
                
        });
    </script>
@endpush

