@if(Session::has('success'))
<div class="alert alert-primary">
  {{ Session::get('success')}}
</div>
@endif

@if(Session::has('login_err'))
<div class="alert alert-danger">
  {{ Session::get('login_err')}}
</div>
@endif