@extends('layouts.master')
@section('title','login')
@section('content')
<section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Login</h3>
            <form class="px-md-2" action="loginuser" id="myForm" method="post">
              @csrf
              @if(Session::get('fail'))
              <div class="alert alert-danger">
                {{ Session::get('fail') }}
              </div>
              @endif
              <div class="form-outline mb-4">
                <label class="form-label" id="lemail" for="form3Example1q">Email</label>
                <input type="text" id="email" name="email" class="form-control" />
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" id="lpassword" for="form3Example1q">Password</label>
                <input type="password" id="password" name="password" class="form-control" />
              </div>
          </div>
          <button type="submit" id="linkButton" class="btn btn-success btn-lg mb-1">Submit</button>
          </form>
        </div>
        <p class="small fw-bold mt-2 pt-1 mb-0">Already Don't have an account? <a href="register" class="link-danger">Register</a></p>
      </div>
    </div>
  </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
  $("#myForm").submit(function(e) {
    var email = $("#email").val();
    var password = $("#password").val();
    if (email == "" && password == "") {
      $("#email").css("border-color", 'red');
      $("#lemail").css({
        'font-family': 'ArvoBold',
        'color': 'red',
        'font-size': '100%'
      });
      $("#password").css("border-color", 'red');
      $("#lpassword").css({
        'font-family': 'ArvoBold',
        'color': 'red',
        'font-size': '100%'
      });
      e.preventDefault();
    } else {
      $("#email").css("border-color", 'unset');
      $("#lemail").css({
        'font-family': 'unset',
        'color': 'unset',
        'font-size': 'unset'
      });
      $("#password").css("border-color", 'unset');
      $("#password").css({
        'font-family': 'unset',
        'color': 'unset',
        'font-size': 'unset'
      });

    }


    if (email == null || email == "") {
      $("#email").css("border-color", 'red');
      $("#lemail").css({
        'font-family': 'ArvoBold',
        'color': 'red',
        'font-size': '100%'
      });
      e.preventDefault();
    } else {
      $("#email").css("border-color", 'unset');
      $("#lemail").css({
        'font-family': 'unset',
        'color': 'unset',
        'font-size': 'unset'
      });

    }
    if (password == null || password == "") {
      $("#password").css("border-color", 'red');
      $("#lpassword").css({
        'font-family': 'ArvoBold',
        'color': 'red',
        'font-size': '100%'
      });
      e.preventDefault();
    } else {
      $("#password").css("border-color", 'unset');
      $("#password").css({
        'font-family': 'unset',
        'color': 'unset',
        'font-size': 'unset'
      });
    }
  });
  var session = "{{Session::get('success')}}"; 
        toastr.options.timeOut = 1000;
        if(session != ''){
            toastr.success(session);
        }

</script>
@endsection