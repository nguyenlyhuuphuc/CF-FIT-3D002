@extends('admin.layout.master')

@section('content'  )
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Category List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Product Category List</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">Product Category List</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="http://localhost:8000/admin/product_category/create" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if(session('message'))
                                @php 
                                    $isSuccess = str_contains(session('message'), 'success');
                                @endphp 
                                <div class="alert alert-{{ $isSuccess ? 'success' : 'danger' }}">
                                    {!! session('message') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>                  
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->slug }}</td>
                                <td>
                                    <div class="btn btn-{{ $data->status ? 'primary' : 'danger' }}">{{ $data->status ? 'Show' : 'Hide' }}</div>
                                </td>
                                <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('admin.product-category.detail', ['id' => $data->id]) }}" class="btn btn-primary">Detail</a>
                                    <form action="{{ route('admin.product-category.destroy', ['id' => $data->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <button type="submit" onclick="return confirm('Are you sure?')" href="" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    @for ($page = 1; $page <= $totalPages; $page++)
                        <li class="page-item"><a class="page-link" href="?page={{ $page }}">{{ $page }}</a></li>
                    @endfor
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection