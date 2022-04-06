@extends('layouts.master')
@section('title','admin-dashboard')
@section('content')

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Admin Dashboard</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="admin-dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="adminlogout">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Logout
                        </a>
                        <!-- Button trigger modal -->
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Add User
                        </a>


            </nav>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="px-md-2" action="adminadduser" id="myForm" method="post">
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="layoutSidenav_content">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                User Details

            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone_no</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($user as $k => $product)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->email }}</td>
                        <td>{{ $product->phone }}</td>
                        <td>
                        <input type="hidden" id="click_{{$k}}" value="{{$product['id']}}">

                            @switch($product->status)
                            @case(3)
                            <span style="color:green">Create by Admin</span>
                            @break;
                            @case(2)
                            <!-- <a href={{"approve/".$product['id']}} class="btn btn-success">Approve</a> -->
                            <!-- <a href={{"decline/".$product['id']}} class="btn btn-danger">Decline</a> -->
                            <button type = "button" class="btn btn-primary" onclick="status_update({{$k}},'approved')">Approved</button>
                            <button type = "button" class="btn btn-danger" onclick="status_update({{$k}},'decline')">Decline</button>
                            @break;
                            @case(1)
                            <!-- <a href={{"decline/".$product['id']}} class="btn btn-danger">Decline</a> -->
                            <button type = "button" class="btn btn-danger" onclick="status_update({{$k}},'decline')">Decline</button>
                            @break;
                            @case(0)
                            <!-- <a href={{"approve/".$product['id']}} class="btn btn-success">Approve</a> -->
                            <button type = "button" class="btn btn-primary" onclick="status_update({{$k}},'approved')">Approved</button>

                            @break;
                            @default
                            <!-- <a href={{"approve/".$product['id']}} class="btn btn-success">Approve</a>
                            <a href={{"decline/".$product['id']}} class="btn btn-danger">Decline</a> -->
                            <button type = "button" class="btn btn-primary" onclick="status_update({{$k}},'approved')">Approved</button>
                            <button type = "button" class="btn btn-danger" onclick="status_update({{$k}},'decline')">Decline</button>

                            @break;
                            @endswitch
                        </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>

</body>


@endsection
@section('scripts')
<script>
       
    $(document).ready(function() {

        var session = "{{Session::get('success')}}";
        toastr.options.timeOut = 1000;
        if (session != '') {
            toastr.success(session);
        }
   
    });
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

  function status_update(key,name) {
   var id = $("#click_"+key).val();
      if(name == 'approved'){
        var url = "{{ url('/')}}/approve";
    }else{
    var url = "{{ url('/')}}/decline";
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })

    $.ajax({
        url: url,
        type: 'POST',
        data: { 
            id:id
        },
        success: function (response) {
            location.reload();
        },
        error: function (error) {
            alert('Something went wrong');
        }
    }); 
        
  }
  
</script>
@endsection