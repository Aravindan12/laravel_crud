



@extends('layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


          <legend style="color: green; font-weight: bold;">LARAVEL 7.X CRUD EXAMPLE - CODECHIEF
           <a href="{{ route('list') }}" style="float: right; display: block;color: white; background-color: green; padding: 1px 5px 1px 5px; text-decoration: none; border-radius: 5px; font-size: 17px;"> CUSTOMER LIST</a>
          </legend>

          <form action="{{ route('update')}}" method="post">
            @csrf
            <div class="form-group">
            <input type="hidden" value="{{$getCustomers->id}}" name="id">
            <div class="form-group">

              <label for="">Name</label>
              <input type="text" name="name" value="{{$getCustomers->name}}">
            </div>
            <div class="form-group">
              <label for="">age</label>
              <input type="text" name="age" value="{{$getCustomers->age}}">

            </div>

            <div class="form-group">
              <label for="">Email</label>
              <input type="text" name="email" value="{{$getCustomers->email}}">

            </div>
            <div class="form-group">
              <label for="">qualification</label>
              <input type="text" name="qualification" value="{{$getCustomers->qualification}}">

            </div>
            
            <div class="form-group" style="margin-top: 24px;">
              <input type="submit" class="btn btn-success" value="Update">
            </div>

          </form>
        </div>
    </div>
</div>
@endsection
 