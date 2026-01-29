@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Category Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Category Create</li>
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
                <h3 class="card-title">Product Category Create</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{ route('admin.product_category.store') }}">
                 {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " id="name" placeholder="Enter name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror " id="slug" placeholder="Enter slug">
                    @error('slug')
                        <div class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror ">
                          <option value="">--- Please select---</option>
                          <option value="1">Show</option>
                          <option value="0">Hide</option>
                        </select>
                      </div>
                  </div>
                  @error('status')
                        <div class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create</button>
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
    $(document).ready(function (){
      $('#name').on('keyup', function(){
          var value = $('#name').val();
        
          $.ajax({
            method: "POST", //method of form
            url: "{{ route('admin.product_category.make-slug') }}", //action of form
            data: { slug: value, _token: "{{ csrf_token() }}" } //input name
          }).done(function(response) {
             $('#slug').val(response.slug); 
          });
 
      });
    });
</script>
@endsection
  
