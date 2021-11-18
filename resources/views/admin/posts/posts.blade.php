@extends('layouts.admin')
@section('title')
    Posts
@endsection

@section('content')
<div class="card">
	<div class="card-header">
        <div class="row">
            <div class="col-md-12">
                <h1 class="card-title">Posts</h1>
                <div class="card-tools float-right">							
                    <a href="{{ route('admin.posts.post-add') }}" class="btn bg-success btn-sm">Add New</a>
                </div>
            </div>			
        </div>
    </div>
	<div class="card-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>					
					<th>id</th>
					<th>name</th>
					<th>category</th>					
					<th>user name</th>
                    <th>image</th>                    
					<th>status</th>
                    <th>publish date</th>
                    <th>created at</th>
                    <th>updated at</th>
                    <th></th>
				</tr>
			</thead>
			<tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $categories->find($post->category_id)->name }}</td>                    
                    <td>{{$post->userName}}</td>
                    <td>
                        @if ($post->image)
                        <img width="200" src="{{ asset( 'storage/'.$post->image) }}" alt="{{ $post->title }}">
                        @else
                        No Image
                        @endif                        
                    </td>
                    <td>
                        @if ($post->status)
                        <button type="submit" class="btn btn-success changeStatus" data-id="{{ $post->id }}">Active</button>
                        @else
                        <button type="submit" class="btn btn-danger changeStatus" data-id="{{ $post->id }}">Pasive</button>
                        @endif                       
                    </td>
                    <td>{{ \Carbon\Carbon::parse($post->publish_date)->format('d-m-Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($post->updated_at)->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.posts.updateShow',$post->id ) }}" class="btn btn-info"><i class="fas fa-pen"></i></a>
                        <button type="button" class="btn btn-danger delete" data-id="{{ $post->id }}"><i class="far fa-trash-alt"></i></button>
                       </td>
                </tr>
                    
                @endforeach
                
            </tbody>
		</table>
	</div>			
</div>
@endsection
@section('js')
    <script>
    $(document).ready(function(){        
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.changeStatus').click(function(){
            let dataID=$(this).data('id');
            let self=$(this);
            $.ajax({
                url:'{{ route("admin.posts.changeStatus") }}',
                method:'POST',
                data:{
                    id:dataID
                },
                async:false,
                success:function(response){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    if (response.status==1) {
                        self[0].classList.remove('btn-danger');
                        self[0].classList.add('btn-success');
                        self[0].innerText='Active';
                        Toast.fire({
                            icon: 'success',
                            title: dataID+' id post changed to active successfully'
                        });
                    }else{
                        self[0].classList.remove('btn-success');
                        self[0].classList.add('btn-danger');
                        self[0].innerText='Pasive';
                        Toast.fire({
                            icon: 'success',
                            title: dataID+' id tag changed to pasive successfully'
                        });
                    }

                },
                error:function(){
                    
                }
            });
        });

        /* Delete with ajax */
        $('#example1').on('click','.delete',function(){
            let self=$(this);
            let dataID=$(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:'{{ route("admin.posts.delete") }}',
                        method:'POST',
                        data:{id:dataID},
                        async:false,
                        success:function(){
                            self[0].closest('tr').remove();
                            Swal.fire(
                                'Deleted!',
                                'Post has been deleted.',
                                'success'
                            )
                        }
                    });
                }
            })
        });
        /* Delete with ajax */

        
    });
    </script>
@endsection