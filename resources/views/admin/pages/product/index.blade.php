@extends('admin.layout.master')

@section('content'  )
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Product List</li>
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
                            <h3 class="card-title">Product List</h3>
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
                            <th>Image</th>
                            <th>Description</th>
                            <th>Product Category Name</th>
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
                                <td>
                                    <img width="100" src="{{ sprintf('%s/%s',asset('images'), $data->image) }}" alt="{{ $data->name }}">
                                </td>
                                <td>
                                    {{ $data->description }}
                                </td>
                                <td>
                                    {{ $data->product_category_name }}
                                </td>
                                <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('admin.product_category.detail', ['id' => $data->id]) }}" class="btn btn-primary">Detail</a>
                                    <form action="{{ route('admin.product_category.destroy', ['id' => $data->id]) }}" method="post">
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
                    {{ $datas->links() }}
                </div>
                </div>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection