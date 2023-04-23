@extends('admin.commons.admin_header')
@section('content')

@php
   $profiles = App\Models\Admin::whereId(Auth::guard('admin')->user()->id)->first();
@endphp

<section style="background-color: #eee;">
  <div class="container py-5">

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">

            @if($profiles->profile_img == null)
            <img src="{{ asset('images\user-img.png') }}" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            @endif

              <h5 class="my-3">{{ $profiles->name }}</h5>
              <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary ms-1">Edit Profile Image</button>
            </div>
          </div>
        </div>
       
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Designation</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ ucfirst(str_replace("_", " ", $profiles->type)) }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $profiles->name }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $profiles->email }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-9">
                 <a href="{{ route('admin/your-profile-edit-page') }}" class="btn btn-primary">Edit Profile</a>
                 <a href="#" class="btn btn-dark">Change Password</a>
              </div>
            </div>
            
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection