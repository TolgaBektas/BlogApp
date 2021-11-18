@extends('layouts.auth')
@section('title')
    Register
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
            <h3>Register</h3>
          <form action="" method="POST"> 
              @csrf
             <!-- Name input -->
             <div class="form-outline mb-4">
                <input type="text" id="name" name="name" class="form-control form-control-lg"
                  placeholder="Enter your full name" autofocus/>
                <label class="form-label" for="name">Full Name</label>
              </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control form-control-lg"
                placeholder="Enter a valid email address" />
              <label class="form-label" for="email">Email Address</label>
            </div>
  
            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="password" name="password" class="form-control form-control-lg"
                placeholder="Enter password" />
              <label class="form-label" for="password">Password</label>
            </div>
  
          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg"
              placeholder="Enter password confirmation" />
            <label class="form-label" for="password_confirmation">Password Confirmation</label>
          </div>
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
            </div>
  
          </form>
        </div>
      </div>
    </div>
</section>
  @endsection