@extends('backend.layout.master')

@section('title', 'Edit Category')

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/iCheck/square/blue.css') }}">
@endpush

@section('content')

    <section class="content-header">
        <h1>
            Edit Category
            <small><a href="{{ route('admin.category.index') }}" class="btn btn-block btn-xs btn-warning btn-flat"><i class="fa fa-plus"></i> BACK</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-md-6">

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Category</h3>
                    </div>

                    <form action="{{ route('admin.category.update',$category->id) }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        @method('PUT')

                        <div class="box-body">
                            <div class="form-group">
                                <label for="categoryname">Category Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}" id="categoryname">
                            </div>
                            <div class="form-group">
                                <label for="categoryimage">Category Image</label>
                                <input type="file" name="image" id="categoryimage">
                                <p class="help-block">(Image must be in .png or .jpg format)</p>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status" {{ $category->status ? 'checked' : '' }}> Active
                                </label>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-flat">Update</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Category Image</h3>
                    </div>
                    <div class="box-body">
                        <img src="{{ asset('images/'.$category->image) }}" alt="{{ $category->name }}" class="img-responsive">
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <!-- iCheck -->
    <script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });
        });
    </script>
@endpush