@extends('layouts.master')
@section('title','customer')
@section('content')
<form class="px-md-2" action="addcustomer" id="myForm" method="post">
    @csrf
    <div class="form-outline mb-4">
        <label class="form-label" id="lname" for="form3Example1q">Enter</label>
        <input type="text" id="home" name="home" class="form-control" />
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
$("#myForm").submit(function(e)
{
    var home = $("#home").val();
    if(home == null || home == "")
    {
      $("#home").css("border-color",'red');
      $("#lname").css({'font-family': 'ArvoBold','color': 'red', 'font-size': '100%' });
      e.preventDefault();
    }
    else
    {
      $("#home").css("border-color",'unset');
      $("#home").css({'font-family': 'unset','color': 'unset', 'font-size': 'unset' });
    }
});
});
</script>
@endsection
