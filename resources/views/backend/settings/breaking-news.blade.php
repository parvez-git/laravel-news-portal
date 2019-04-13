@extends('backend.layout.master')

@section('title', 'Setting Breaking News')

@section('content')

    <section class="content-header">
        <h1>
            Breaking News Setting
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Select Category of Breaking News</h3>
                    </div>

                    <form action="{{ route('admin.settings.breakingnews.store') }}" method="POST" role="form">
                        @csrf

                        <div class="box-body">

                            <div class="form-group">
                                <label>Category</label>
                                <select name="breaking_news_category_id" class="form-control" style="width: 100%;">
                                    <option selected disabled> --Select Category-- </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($setting->breaking_news_category_id==$category->id){{'selected'}}@endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat">UPDATE</button>
                        </div>

                    </form>

                </div>
            </div>
                
        </div>
    </section>

@endsection