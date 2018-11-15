@extends('backend.layout.master')

@section('title', 'Edit Menu')

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/components/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')

    <section class="content-header">
        <h1>
            Menu
            <small><a href="{{ route('admin.menus.index') }}" class="btn btn-block btn-xs btn-warning btn-flat"><i class="fa fa-plus"></i> BACK</a></small>
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
                        <h3 class="box-title">Edit Menu</h3>
                    </div>

                    <form action="{{ route('admin.menus.update',$menu->id) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')

                        <div class="box-body">
                            <div class="form-group">
                                <label>Menu Name</label>
                                <input type="text" name="name" class="form-control" id="editmenuname" value="{{ $menu->name }}">
                            </div>

                            <div class="form-group">
                                <label>Menu Order</label>
                                <input type="number" name="menuorder" class="form-control" id="editmenuorder" min="0" value="{{ $menu->menuorder }}">
                            </div>

                            <div class="form-group">
                                <label>Menu Parent</label>
                                <input type="number" name="parent_id" class="form-control" id="editparentid" min="0" value="{{ $menu->parent_id }}">
                            </div>

                            <div class="form-group">
                                <label>Menu URL</label>
                                <input type="text" name="menu_url" class="form-control" id="editmenuurl" value="{{ $menu->menu_url }}" readonly>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat">Update Menu</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script src="{{ asset('backend/components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function(){
        $('.select2').select2();
    });
</script>
@endpush