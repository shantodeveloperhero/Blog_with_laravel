@extends('backend.layouts.master')
@section('page_title', 'Tag')
@section('page_sub_title', 'List')
@section('content')
    
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tag List</h5>
            <a href="{{ route('tag.create') }}"><button class="btn btn-success" class="float-end">Add</button></a>
          </div>
          <div class="card-body">
                 <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead class="table-light">
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Status</th>
                          <th>Order By</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @php
                            $sl = 1
                        @endphp
                        @foreach ($tags as $tag)
                        <tr>
                          <td>{{ $sl++ }}</td>
                          <td>{{ $tag->name }}</td>
                          <td>{{ $tag->slug }}</td>
                          <td>{{ $tag->status ==1? 'active': 'inactive' }}</td>
                          <td>{{ $tag->order_by }}</td>
                          <td>
                            <div class="d-flex justify-content-center">
                              <a href="{{ route('tag.show', $tag->id) }}"> <button class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                              <a href="{{ route('tag.edit', $tag->id) }}"> <button class="btn btn-warning btn-sm mx-1"><i class="fa-solid fa-edit"></i></button></a>
                              {!! Form::open(['method'=>'delete', 'id'=>'form_'.$tag->id, 'route'=>['tag.destroy', $tag->id]]) !!}
                              {!! Form::button('<i class="fa-solid fa-trash"></i>', ['type'=>'button', 'data-id'=> $tag->id, 'class'=>' delete btn btn-danger btn-sm']) !!}
                              {!! Form::close() !!}
                            </div>
                              
                            </td>
                        </tr>
                        @endforeach  
                      </tbody>
                    </table>
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