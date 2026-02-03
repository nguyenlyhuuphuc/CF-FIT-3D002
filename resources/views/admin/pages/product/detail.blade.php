@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Detail</li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" method="post" action="{{ route('admin.product.update', ['product' => $product->id]) }}">
                 {{ csrf_field() }}
                 @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" value="{{ $product->name }}" name="name" class="form-control @error('name') is-invalid @enderror " id="name" placeholder="Enter name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" value="{{ $product->price }}" name="price" class="form-control @error('price') is-invalid @enderror " id="price" placeholder="Enter price">
                    @error('price')
                        <div class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="number" value="{{ $product->qty }}" name="qty" class="form-control @error('qty') is-invalid @enderror " id="qty" placeholder="Enter qty">
                    @error('qty')
                        <div class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror " id="image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                     <div id="description_html">{!! $product->description !!}</div>
                    <input type="hidden" name="description" id="description">
                    <!-- <textarea class="form-control @error('description') is-invalid @enderror " name="description" id="description"></textarea> -->
                    @error('description')
                        <div class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror ">
                          <option value="">--- Please select---</option>
                          <option {{ $product->status == '1' ? 'selected' : '' }} value="1">Show</option>
                          <option {{ $product->status == '0' ? 'selected' : '' }} value="0">Hide</option>
                        </select>
                      </div>
                  </div>
                  @error('status')
                        <div class="text-danger">{{ $message }}</small>
                  @enderror
                  <div class="form-group">
                      <label for="product_category_id">Product Category</label>
                      <select name="product_category_id" id="product_category_id" class="form-control @error('product_category_id') is-invalid @enderror ">
                        <option value="">--- Please select---</option>
                        @foreach ($productCategories as $productCategory)
                          <option {{ $product->product_category_id == $productCategory->id ? 'selected' : '' }} value="{{ $productCategory->id}}">{{ $productCategory->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  @error('product_category_id')
                    <div class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection
  
@section('my-js')
<script type="text/javascript">
  $(document).ready(function(){
      //B1
      const quill = new Quill('#description_html', {
        theme: 'snow'
      });
      //B2
      quill.on('text-change', function(delta, oldDelta, source) {
          document.getElementById("description").value = quill.root.innerHTML;
      });
  });
</script>
@endsection