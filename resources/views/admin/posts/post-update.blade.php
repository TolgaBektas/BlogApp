@extends('layouts.admin')
@section('title')
    Update Post
@endsection

@section('content')
<div class="col-md-12">
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Update your post!</h3>
    </div>
    <div class="col-md-8 m-auto">
      <form method="POST" action="{{ route('admin.posts.update') }}" id="update-form"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">

          <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" placeholder="Enter post title">
          </div>

          <div class="form-group">
            <label for="summernote">Post Content</label>
            <textarea class="form-control" id="summernote" name="content" rows="5" placeholder="Enter post's content...">{!! $post->content !!}</textarea>
          </div>

          @if ($post->image)
            <div class="form-group">
                <label for="currentImage">Current Image</label>
                <img width="250" src="{{ '/storage/'.$post->image }}">
            </div>            
          @endif
          
          <div class="form-group">
            <label for="image">Post Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @error('image')
                <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id" id="category_id">
              @foreach ($categories as $item)
              <option {{ $item->id==$post->category_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Tags <small><i>*You can choose multiple!</i></small></label>
           
            <select multiple="" class="form-control"  name="tags_id[]" id="tags_id[]">  
                
              @foreach ($tags as $tag)
                  <option 
                  @foreach ($selectedTags as $selectedTag )
                    @if ($selectedTag==$tag->id)
                        selected
                    @endif
                  @endforeach
                   value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
             
            </select>
          </div>

          <div class="form-group">
            <label>Date and time</label>
            <label><small><i>*The date when the post will be published.</i></small></label>
            <label><small><i>*If you leave empty, post will be publish as soon as possible.</i></small></label>
            <div class="input-group">
              <input type="datetime-local" class="form-control" name="publish_date" id="publish_date" value="{{ \Carbon\Carbon::parse($post->publish_date)->format('Y-m-d\TH:i:s') }}">              
             
            </div>
          </div>
          
          <div class="form-check">
            <input type="checkbox" {{ $post->status ? 'checked' : '' }} class="form-check-input" name="status" id="status">
            <label class="form-check-label" for="status">Status</label>
          </div>
        </div>
        

        </div>
        <input type="hidden" name="old_image" value="{{ $post->image }}">
        <input type="hidden" name="id" value="{{ $post->id }}">
        <div class="card-footer"><button type="button" id="update" class="btn btn-success">Submit</button></div>
      </form>
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
        if ($('#title').val().trim()=="") {
            $('#title').focus();
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Title can not be empty!',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            });
            
        }else if($('#summernote').val().trim()==""){
          $('#summernote').focus();
          Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Content can not be empty!',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            });
          }else{
            $('#update-form').submit();
          }
        });
      });
    
</script>
@endsection