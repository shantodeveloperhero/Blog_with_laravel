@extends('backend.layouts.master')
@section('page_title', 'Post')
@section('page_sub_title', 'Details')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-8">
            <h5>Post Details</h5>
          <div class="card-body">
                @if ($errors->any())
                   <div class="alert alert-danger">
                 <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
                 </ul>
                 </div>
                @endif
                <div class="table-responsive text-nowrap">
                    <table class="table">
                      <tbody class="table-light">
                        <tr>
                          <th>SL</th>
                          <td>{{ $post->id }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $post->title }}</td>
                        </tr>
                          
                          <tr>
                            <th>Slug</th>
                            <td>{{ $post->slug }}</td>
                          </tr>
                          <tr>
                            <th>Status</th>
                            <td>{{ $post->status ==1? 'active': 'inactive' }}</td>
                          </tr>
                          <tr>
                            <th>Is Approved</th>
                            <td>{{ $post->is_approved ==1? 'Approved': 'Not Approved' }}</td>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <td>{!! $post->description !!}</td>
                          </tr>
                          <tr>
                            <th>Admin-Comment</th>
                            <td>{{  $post->admin_comment }}</td>
                          </tr>

                          <tr>
                            <th>Photo</th>
                            <td><img class="img-thumbnail post_image" data-src="{{ url('image/post/original/'.$post->photo) }}" src="{{ url('image/post/thumbnail/'.$post->photo) }}" alt="{{ $post->title }}">
                          
                            </tr>
                            
                      </tbody>
                      
                    </table>

                    <td>
                      <a href="{{ route('post.index') }}" class="btn btn-success btn-sm mt-2">Back</a>
                  </td>
                  
                  </div>         
                </div>
        
            </div>
          </div>
        
        
       
 @endsection

 @push('js')
<script>
        

      $('.approve').on('click', function(){
        let id = $(this).attr('data-id')

        Swal.fire({
          title: 'Are you sure to approve?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $(`#form_${id}`).submit()
          }
        })

      })
          

       
</script>