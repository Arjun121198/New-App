@extends('layouts.master')
@section('title','register')
@section('content')
<section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img3.webp" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration</h3>
            @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif
            <form class="px-md-2" action="registeruser" id="myForm" method="post">
             @csrf
              <div class="form-outline mb-4">
              <label class="form-label" id="lname" for="form3Example1q">Name</label>
                <input type="text" id="name" name="name" class="form-control" />
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
              <div class="form-outline mb-4">
              <label class="form-label" id="lemail" for="form3Example1q">Email</label>
                <input type="text" id="email" name="email" class="form-control" />
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
              <div class="form-outline mb-4">
              <label class="form-label" id="lpassword" for="form3Example1q">Password</label>
                <input type="text" id="password" name="password" class="form-control" />
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
              <div class="form-outline mb-4">
              <label class="form-label" id="lphone" for="form3Example1q">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" />
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
              </div>
              <button type="submit" class="btn btn-success btn-lg mb-1">Submit</button>
            </form>
          </div>
          <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login"
                      class="link-danger">Login</a></p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
  $("#myForm").submit(function(e)
  {
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var phone = $("#phone").val();
    if(email == "" && password == "" && name == "" && phone == "")
    {
      $("#name").css("border-color",'red');
      $("#lname").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      $("#email").css("border-color",'red');
      $("#lemail").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      $("#password").css("border-color",'red');
      $("#lpassword").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      $("#phone").css("border-color",'red');
      $("#lphone").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      e.preventDefault();
    }
    else
    {
      $("#name").css("border-color",'unset');
      $("#lname").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
      $("#email").css("border-color",'unset');
      $("#lemail").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
      $("#password").css("border-color",'unset');
      $("#password").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
      $("#phone").css("border-color",'unset');
      $("#lphone").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });


    }
    if(name == null || name == "")
    {
      $("#name").css("border-color",'red');
      $("#lname").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      e.preventDefault();
    }
    else
    {
      $("#name").css("border-color",'unset');
      $("#lname").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });

    }

    if(email == null || email == "")
    {
      $("#email").css("border-color",'red');
      $("#lemail").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      e.preventDefault();
    }
    else
    {
      $("#email").css("border-color",'unset');
      $("#lemail").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
    }
    if(password ==null || password == "")
    {
      $("#password").css("border-color",'red');
      $("#lpassword").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      e.preventDefault();
    }
    else
    {
      $("#password").css("border-color",'unset');
      $("#password").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
    }
    if(phone ==null || phone == "")
    {
      $("#phone").css("border-color",'red');
      $("#lphone").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      e.preventDefault();
    }
    else
    {
      $("#phone").css("border-color",'unset');
      $("#lphone").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
    }
  });
</script>  
@endsection