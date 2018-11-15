@extends('backend.layout.master')

@section('title', 'News')

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')

    <section class="content-header">
        <h1>
            News List
            <small><a href="{{ route('admin.news.create') }}" class="btn btn-block btn-xs btn-success btn-flat"><i class="fa fa-plus"></i> CREATE</a></small>
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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hover Data Table</h3>
                    </div>

                    <div class="box-body">
                        <table id="category-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Details</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($newslist as $news)
                                <tr>
                                    <td>{{ $news->id }}</td>
                                    <td>
                                        <img src="{{ asset('images/'.$news->image) }}" alt="{{ $news->title }}" width="120px">
                                    </td>
                                    <td>{{ $news->title }}</td>
                                    <td>{{ $news->slug }}</td>
                                    <td>{{ str_limit(strip_tags($news->details),300) }}</td>
                                    <td>{{ @$news->category->name }}</td>
                                    <td>{{ $news->status ? 'Published' : 'Unpublished' }}</td>
                                    <td>{{ $news->featured ? 'Featured' : '' }}</td>
                                    <td>{{ $news->view_count }}</td>
                                    <td>
                                        <div class="btn-group-vertical">
                                            <a href="" class="btn btn-primary btn-flat"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.news.edit',$news->id) }}" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-flat"
                                                onclick="event.preventDefault();
                                                    document.getElementById('news-delete-form-{{$news->id}}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="news-delete-form-{{$news->id}}" action="{{ route('admin.news.destroy',$news->id) }}" method="POST" style="display: none;">
                                                @csrf 
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Details</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('backend/components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function(){
            $('#category-table').DataTable();
        })
    </script>
@endpush