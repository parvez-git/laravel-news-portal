@extends('backend.layout.master')

@section('title', 'Create Menu')

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/components/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')

    <section class="content-header">
        <h1>
            Menu
            <small><a href="{{ route('admin.menus.index') }}" class="btn btn-block btn-xs btn-warning btn-flat"><i class="fa fa-arrow-left"></i> BACK</a></small>
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
                        <h3 class="box-title">Select Menu</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            <label>Menu Type</label>
                            <select name="menutype" id="selectmenutype" class="form-control" style="width: 100%;">
                                <option selected disabled> --Select Type-- </option>
                                <option value="category">Category</option>
                                <option value="news">News</option>
                                <option value="page">Page</option>
                            </select>
                        </div>

                        <div class="form-group" id="displaymenuitem">
                            <label>Select as Menu</label>
                            <select name="menuitem" id="selectmenuitem" class="form-control select2" style="width: 100%;">
                                <option selected disabled> --Select Menu-- </option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add to Menu</h3>
                    </div>

                    <form action="{{ route('admin.menus.store') }}" method="POST" role="form">
                        @csrf
                        <input type="hidden" name="type" id="menutype">

                        <div class="box-body">
                            <div class="form-group">
                                <label>Menu Name</label>
                                <input type="text" name="name" class="form-control" id="menuname">
                            </div>

                            <div class="form-group" id="displaymenuurl">
                                <label>Menu URL</label>
                                <input type="text" name="menu_url" class="form-control" id="menuurl" readonly>
                            </div>

                            <div class="form-group">
                                <label>Menu Order</label>
                                <input type="number" name="menuorder" class="form-control" id="menuorder" min="0" value="0">
                            </div>

                            <div class="form-group">
                                <label>Menu Parent</label>
                                <select name="parent_id" class="form-control" style="width: 100%;">
                                    <option selected value="0"> --Select Parent Menu-- </option>
                                    @foreach ($menus as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat">Add to Menu</button>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function(){

        $('#displaymenuitem').hide();
        $('.select2').select2();

        $('#selectmenutype').on('change', function(){
            var menutype = this.value;

            if(menutype == 'page'){

                $('#menutype').val(menutype);
                $("#menuname").prop('required',true);
                $('#menuurl').attr('readonly',false);
                $("#menuurl").prop('required',true);

            }else{
                $('#menuurl').attr('readonly',true);

                $.post("{{ route('admin.menuitems.json') }}", { menutype : menutype }, function(data){
                    
                    if(data.menuitems.length){

                        var options = '<option selected disabled> --Select Menu-- </option>';
                        data.menuitems.forEach(function(option){
                            options += '<option value="'+option.id+'">'+option.name+'</option>';
                        })
                        
                        $('#selectmenuitem').empty().append(options);

                        $('#displaymenuitem').show();
                    }else{
                        $('#menutype').val('');
                        $('#displaymenuitem').hide();
                    }

                    // SECOND LEVEL
                    $('#selectmenuitem').on('change', function(){
                        var menuitemid = this.value;

                        $.post("{{ route('admin.menuitemsdetails.json') }}", 
                        { 
                            menutype   : menutype, 
                            menuitemid : menuitemid 
                        }, 
                        function(dataitem){
                            if(dataitem.menudetails){

                                $('#menutype').val(menutype);

                                if(dataitem.menudetails.hasOwnProperty('title')){
                                    $('#menuname').val(dataitem.menudetails.title);
                                    $('#menuurl').val("{{ URL('/') }}/page/news/"+dataitem.menudetails.slug);
                                }else if(dataitem.menudetails.hasOwnProperty('name')){
                                    $('#menuname').val(dataitem.menudetails.name);
                                    $('#menuurl').val("{{ URL('/') }}/page/category/"+dataitem.menudetails.slug);
                                }
                            }
                        })
                    })
                })

            }

        });

    });
</script>
@endpush