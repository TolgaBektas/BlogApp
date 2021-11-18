@extends('layouts.auth')
@section('title')
Verify Your Email Address
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
 
<section class="center">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8 col-lg-6 col-xl-4">

            @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                A fresh verification link has been sent to your email address.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

            <div class="card">
                <div class="card-header">
                  Verify Your Email Address
                </div>
                <div class="card-body">                  
                  Before proceeding, please check your email for a verification link. If you did not receive the email,
                      <form class="d-inline" method="POST" action="{{route('verification.send')}}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another.</button>
                    </form>
                    
                </div>
              </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('js')
@endsection