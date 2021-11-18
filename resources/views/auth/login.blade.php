@extends('layouts.auth')
@section('title')
    Login
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
            <h3>Login</h3>
          <form method="POST"> 
            @csrf
            {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
            @endforeach
                
            @endif --}}
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control form-control-lg"
                placeholder="Enter a valid email address" />
              <label class="form-label" for="email">Email address</label><br>
              @error('email')
                  <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
  
            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="password" name="password" class="form-control form-control-lg"
                placeholder="Enter password" />
              <label class="form-label" for="password">Password</label><br>
              @error('password')
                  <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
  
            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" />
                <label class="form-check-label" for="remember">
                  Remember me
                </label>
              </div>
              <a href="{{route('password.request')}}">Forgot password?</a>
            </div>
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{route('register')}}"
                  class="link-danger">Register</a></p>
            </div>
  
          </form>
        </div>
      </div>
    </div>
</section>
@endsection