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
            <h3>Reset Password</h3>
          <form action="{{route('password.update')}}" method="POST"> 
            @csrf
            <input type="hidden" name="token" value="{{ request()->token }}">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter your email address" />
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter your new password" />
            @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <!-- Password Confirmation input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="password_confirmation">New Password Confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" placeholder="Enter your new password again" />
            @error('password_confirmation')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Reset Password</button>
            </div>  
          </form>
        </div>
      </div>
    </div>
</section>
@endsection
@section('js')
@endsection