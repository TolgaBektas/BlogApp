@extends('layouts.auth')
@section('title')
Reset Password
@endsection
@section('css')
<style>
.center {
  padding: 20vh 0;
}
body{
  background-color: darkslategray;
}
</style>
@endsection
@section('content') 
<section class="text-white center">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center align-items-center">
       
        <div class="col-md-8 col-lg-6 col-xl-4">
            @if (session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <h3>Reset Password</h3>
          <form action="{{route('password.email')}}" method="POST"> 
              @csrf

            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter a valid email address" />
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Send Password Reset Link</button>
            </div>
  
          </form>
        </div>
      </div>
    </div>
</section>
@endsection
@section('js')
@endsection