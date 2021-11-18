@extends('layouts.admin')
@section('title')
    Profile
@endsection

@section('content')
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Update your profile!</h3>
        </div>
       
        <div class="col-md-8 m-auto">
            <form method="POST" autocomplete="off" action="{{ route('user-profile-information.update') }}" id="update-form">
              @csrf
              @method('PUT')
              @if (session('status')=="profile-information-updated")
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Profile information is updated.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              <div class="card-body">

                <div class="form-group">
                  <label for="name">Your Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Enter your name...">
                </div>
                
                <div class="form-group">
                    <label for="email">Your Email Adress</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Enter your email adress...">
                </div>
               
                {{-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="status">
                  <label class="form-check-label" for="status">Status (it will suspend all your post if you uncheck.)</label>
                </div> --}}

              </div>
              <div class="card-footer">
                <button type="button" id="update" class="btn btn-success">Save</button>
              </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Update your password!</h3>
        </div>
       
        <div class="col-md-8 m-auto">
            <form method="POST" autocomplete="off" action="{{ route('user-password.update') }}" id="update-form">
              @csrf
              @method('PUT')
              @if (session('status')=="password-updated")
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Password updated successfully.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              <div class="card-body">

                <div class="form-group">
                  <label for="current_password">Your Current Password</label>
                  <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter your current password...">
                    @error('current_password','updatePassword')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Your New Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your new password...">
                    @error('password','updatePassword')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Your New Password Confirmation</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter your new password confirmation...">
                    @error('password_confirmation','updatePassword')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                
                
            
              </div>
              <div class="card-footer">
                <button type="submit" id="update" class="btn btn-success">Save</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
  $(document).ready(function(){
    $(function () {    
        $('#summernote').summernote()

        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    });
    $('#update').click(function(){
        if ($('#name').val().trim()=="") {
            $('#name').focus();
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Name can not be empty!',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            })
            
        }else if($('#email').val().trim()==""){
            $('#email').focus();
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Email can not be empty!',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            })
        }else if(!validateEmail($('#email').val().trim())){
            $('#email').val("");
            $('#email').focus();
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Email is not valid!',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            })            
        }else{
            $('#update-form').submit();
        }
    });
    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
  });
</script>
@endsection