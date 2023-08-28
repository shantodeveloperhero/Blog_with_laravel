@extends('backend.layouts.master')
@section('page_title', 'Post')
@section('page_sub_title', 'List')
@section('content')
    
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Post List</h5>
            <a href="{{ route('post.create') }}"><button class="btn btn-success" class="float-end">Add</button></a>
          </div>
          <div class="card-body">
                 <div class="table-responsive text-nowrap">
                    <table class="table post-table" >
                      <thead class="table-light">
                        <tr>
                          <th>SL</th>
                          <th class="align-middle">
                            <p>Title</p>
                            <hr/>
                            <p>Slug</p>
                          </th>
                          <th>
                            <p>Category</p>
                            <hr/>
                            <p>Sub Category</p>
                          </th>
                          
                          <th>
                            <p>Status</p>
                          </th>
                          <th>Is Approve</th>
                          <th>Photo</th>
                          <th>Tags</th>
                          <th>Created By</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @php
                            $sl = 1
                        @endphp
                        @foreach ($posts as $post)
                        <tr>
                          <td>{{ $sl++ }}</td>
                          <td>
                            <p>{{ $post->title }}</p>
                            <hr/>
                            <p>{{ $post->slug }}</p>
                          </td>
                          <td>
                            <p>{{ $post->category?->name }}</p>
                            <hr/>
                            <p>{{ $post->sub_category?->name }}</p>
                          </td>
                          <td>
                            <p>{{ $post->status == 1 ? 'Published' : 'Not Published' }}</p>
                            
                          </td>
                          <td>
                            
                            <p>
                            <a href="{{ route('post.approve', $post->id) }}" class="btn btn-success" >Published Now</a>
                        </p>
                          </td>
                          <td>
                            <img class="img-thumbnail post_image" data-src="{{ url('image/post/original/'.$post->photo) }}" src="{{ url('image/post/thumbnail/'.$post->photo) }}" alt="{{ $post->title }}">  
                          </td>
                          <td>
                            @php
                              $classes = ['btn-success', 'btn-info', 'btn-danger', 'btn-warning']
                            @endphp
                            @foreach ($post->tag as $tag)
                            <button class="btn btn-sm  {{ $classes[random_int(0,3)] }} mb-1">{{ $tag->name }}</button>
                              
                            @endforeach
                          </td>
                          <td>{{ $post->user?->name }}</td>
                          <td>
                            <div class="d-flex justify-content-center">
                              <a href="{{ route('post.show', $post->id) }}"> <button class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                              <a href="{{ route('post.edit', $post->id) }}"> <button class="btn btn-warning btn-sm mx-1"><i class="fa-solid fa-edit"></i></button></a>
                              {!! Form::open(['method'=>'delete', 'id'=>'form_'.$post->id, 'route'=>['post.destroy', $post->id]]) !!}
                              {!! Form::button('<i class="fa-solid fa-trash"></i>', ['type'=>'button', 'data-id'=> $post->id, 'class'=>' delete btn btn-danger btn-sm']) !!}
                              {!! Form::close() !!}
                            </div>
                              
                            </td>
                        </tr>
                        @endforeach  
                      </tbody>
                     
                    </table>
                    
                    
                    

                  </div>
                </div>
              </div>
              <button id="image_show_button" type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#image_show"></button>

                  <div class="modal fade" id="image_show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Blog Image</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <img class="img_thumbnail" src="" alt="Display Image" id="display_img">
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

                  



                  @if(session('msg'))
                 
                  @push('js')
                 <script>
                   Swal.fire({
                    position: 'top-end',
                    icon: '{{session('cls')}}',
                    toast:true,
                    title: '{{ session('msg') }}',
                    showConfirmButton: false,
                    timer: 3000
                  })
                 </script>
                    
                  @endpush

                  @endif

@push('js')
<script>
        $('.post_image').on('click', function(){
          let img = $($this).attr('data-src')
          $('#display_img').attr('src', img)
          $('#image_show_button').trigger('click')
        })

      $('.delete').on('click', function(){
        let id = $(this).attr('data-id')

        Swal.fire({
          title: 'Are you sure to delete?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $(`#form_${id}`).submit()
          }
        })

      })
          

       
</script>
@endpush
@endsection