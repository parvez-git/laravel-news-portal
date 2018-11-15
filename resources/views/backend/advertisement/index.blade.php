@extends('backend.layout.master')

@section('title', 'Advertisement Settings')

@push('styles')

@endpush

@section('content')

    <section class="content-header">
        <h1>
            Advertisements Settings
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_home" data-toggle="tab">Home Page</a></li>
                        @foreach ($categories as $key => $category)
                            <li><a href="#tab_{{$category->id}}" data-toggle="tab">{{$category->name}} Page</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab_home">
                            <form action="{{ route('admin.advertisements.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="type" value="home">
                                <input type="hidden" name="slug" value="home">

                                <div class="box-body">
                                    
                                    <div class="form-group">
                                        <label for="header-top-home" class="col-sm-2 col-md-2 control-label">Header Top Ads:</label>
                                        <div class="col-sm-10 col-md-4">
                                            <input type="file" name="header_top" class="form-control" id="header-top-home">
                                        </div>
                                        <div class="col-sm-10 col-md-6">
                                            @foreach($advertisement as $ads)
                                                @if($ads->type == 'home' && $ads->header_top)
                                                    <div class="bgimage" style="background-image:url({{ asset('images/advertisements/'.$ads->header_top) }})"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="ads-body-home" class="col-sm-2 col-md-2 control-label">Body Midddle Ads:</label>
                                        <div class="col-sm-10 col-md-4">
                                            <input type="file" name="body_middle" class="form-control" id="ads-body-home">
                                        </div>
                                        <div class="col-sm-10 col-md-6">
                                            @foreach($advertisement as $ads)
                                                @if($ads->type == 'home' && $ads->body_middle)
                                                    <div class="bgimage" style="background-image:url({{ asset('images/advertisements/'.$ads->body_middle) }})"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="ads-sidebar-home" class="col-sm-2 col-md-2 control-label">Sidebar One:</label>
                                        <div class="col-sm-10 col-md-4">
                                            <input type="file" name="sidebar_one" class="form-control" id="ads-sidebar-home">
                                        </div>
                                        <div class="col-sm-10 col-md-6">
                                            @foreach($advertisement as $ads)
                                                @if($ads->type == 'home' && $ads->sidebar_one)
                                                    <div class="bgimage" style="background-image:url({{ asset('images/advertisements/'.$ads->sidebar_one) }})"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info btn-flat">SAVE</button>
                                </div>

                            </form>
                        </div>

                        @foreach ($categories as $key => $category)
                        
                            <div class="tab-pane" id="tab_{{$category->id}}">
                               
                                <form action="{{ route('admin.advertisements.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <input type="hidden" name="type" value="category">
                                    <input type="hidden" name="slug" value="{{$category->slug}}">

                                    <div class="box-body">
                                        
                                        <div class="form-group">
                                            <label for="header-top-{{$category->slug}}" class="col-sm-2 col-md-2 control-label">Header Top Ads:</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="file" name="header_top" class="form-control" id="header-top-{{$category->slug}}">
                                            </div>
                                            <div class="col-sm-10 col-md-6">
                                                @foreach($advertisement as $ads)
                                                    @if($ads->slug == $category->slug && $ads->header_top)
                                                        <div class="bgimage" style="background-image:url({{ asset('images/advertisements/'.$ads->header_top) }})"></div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="ads-body-{{$category->slug}}" class="col-sm-2 col-md-2 control-label">Body Midddle Ads:</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="file" name="body_middle" class="form-control" id="ads-body-{{$category->slug}}">
                                            </div>
                                            <div class="col-sm-10 col-md-6">
                                                @foreach($advertisement as $ads)
                                                    @if($ads->slug == $category->slug && $ads->body_middle)
                                                        <div class="bgimage" style="background-image:url({{ asset('images/advertisements/'.$ads->body_middle) }})"></div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="ads-sidebar-{{$category->slug}}" class="col-sm-2 col-md-2 control-label">Sidebar One:</label>
                                            <div class="col-sm-10 col-md-4">
                                                <input type="file" name="sidebar_one" class="form-control" id="ads-sidebar-{{$category->slug}}">
                                            </div>
                                            <div class="col-sm-10 col-md-6">
                                                @foreach($advertisement as $ads)
                                                    @if($ads->slug == $category->slug && $ads->sidebar_one)
                                                        <div class="bgimage" style="background-image:url({{ asset('images/advertisements/'.$ads->sidebar_one) }})"></div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info btn-flat">SAVE</button>
                                    </div>

                                </form>
                            </div>

                        @endforeach

                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
    $(function () {
        // $('.textarea').wysihtml5();
    });
</script>
@endpush