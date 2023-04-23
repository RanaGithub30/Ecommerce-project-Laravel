@extends('admin.commons.admin_header')
@section('content')

<!-- Main content -->
    <section class="content m-5">

        @if(Session::has('success'))
            <div class="success">{{ Session::get('name') }}</div>
        @endif


      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Your Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form action="{{ route('admin/edit-profile-action') }}" method="post">
                @csrf

                 <div class="card-body">
                    <div class="form-group">
                            <label for="exampleInputPassword1">Name</label>
                            <input type="text" class="form-control" name="name" id="exampleInputPassword1" placeholder="Your Name" value="{{ Auth::guard('admin')->user()->name }}">
                            @if($errors->has('name'))
                              <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" value="{{ Auth::guard('admin')->user()->email }}">
                        @if($errors->has('email'))
                         <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    </div>
                    
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Edit Profile</button>
                  </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
</div>

@endsection