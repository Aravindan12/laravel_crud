
@extends('layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
          @endif

          <legend style="color: green; font-weight: bold;">LARAVEL CRUD
           <a href="{{ route('list') }}" style="float: right; display: block;color: white; background-color: green; padding: 1px 5px 1px 5px; text-decoration: none; border-radius: 5px; font-size: 17px;"> CUSTOMER LIST</a>
          </legend>

          <form action="#" method="post" id = "form">
            @csrf
            
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter name">
              <font style="color:red"> {{ $errors->has('name') ?  $errors->first('name') : '' }} </font>
            </div>
            <div class="form-group">
              <label for="">age</label>
              <input type="text" class="form-control" name="age" value="{{ old('age') }}" placeholder="Enter age">
              <font style="color:red"> {{ $errors->has('age') ?  $errors->first('name') : '' }} </font>
            </div>

            <div class="form-group">
              <label for="">Email</label>
              <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email">
              <font style="color:red"> {{ $errors->has('email') ?  $errors->first('email') : '' }} </font>
            </div>
            <div class="form-group">
              <label for="">qualification</label>
              <input type="text" class="form-control" name="qualification" value="{{ old('qualification') }}" placeholder="Enter qualification">
              <font style="color:red"> {{ $errors->has('qualification') ?  $errors->first('qualification') : '' }} </font>
            </div>
            
            <div class="form-group" style="margin-top: 24px;">
              <input type="submit" class="btn btn-primary" value="Submit">
            </div>

          </form>
        </div>
    </div>
</div>


<!-- show data -->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <!-- <a href="{{ route('list') }}" style="float: right; display: block;color: white; background-color: green; padding: 1px 5px 1px 5px; text-decoration: none; border-radius: 5px; font-size: 17px;"> CUSTOMER LIST</a> -->
        <table class="table table-striped" id="table">
    <thead>
        <tr>
          
          <td>Name</td>
          <td>Age</td>
          <td>Email</td>
          <td>qualification</td>

          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($getCustomers as $customer)
        <tr>
        
            
            <td>{{$customer->name}}</td>
            <td>{{$customer->age}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->qualification}}</td>
  
            <td>
                <a href="{{ route('edit',$customer->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('delete', $customer->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <a href="{{ route('add') }}" style="float: right; display: block;color: white; background-color: green; padding: 1px 5px 1px 5px; text-decoration: none; border-radius: 5px; font-size: 17px;">ADD CUSTOMER</a>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$('#form').submit(function(e){
  e.preventDefault();

  var name = $("input[name=name]").val();
  // console.log(name);
  var age = $("input[name=age]").val();
  var email = $("input[name=email]").val();
  var qualification = $("input[name=qualification]").val();
  var _token = $("input[name=_token]").val();

  $.ajax({
    url:"{{route('customer.add')}}",
    type:"POST",
    data:{
      
      name:name,
      age:age,
      email:email,
      qualification:qualification,
      _token:_token
    },
    success:function(response){
      console.log(response)
      $('#table tbody').prepend('<tr><td>'+name+'</td><td>'+age+'</td><td>'+email+'</td><td>'+qualification+'<td></tr>');
      $('#form')[0].reset();
    }
  })
})
</script>
@endsection
 