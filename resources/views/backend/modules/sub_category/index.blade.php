@extends('backend.layouts.master')
@section('page_title', 'Sub Category')
@section('page_sub_title', 'List')
@section('content')
    
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Sub Category List</h5>
            <a href="{{ route('category.create') }}"><button class="btn btn-success" class="float-end">Add</button></a>
          </div>
          <div class="card-body">
                 <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead class="table-light">
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Slug</th>
                          <th>Status</th>
                          <th>Order By</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @php
                            $sl = 1
                        @endphp
                        @foreach ($sub_categories as $sub_category)
                        <tr>
                          <td>{{ $sl++ }}</td>
                          <td>{{ $sub_category->name }}</td>
                          <td>{{ $sub_category->category->name }}</td>
                          <td>{{ $sub_category->slug }}</td>
                          <td>{{ $sub_category->status ==1? 'active': 'inactive' }}</td>
                          <td>{{ $sub_category->order_by }}</td>
                          <td>
                            <div class="d-flex justify-content-center">
                              <a href="{{ route('sub-category.show', $sub_category->id) }}"> <button class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                              <a href="{{ route('sub-category.edit', $sub_category->id) }}"> <button class="btn btn-warning btn-sm mx-1"><i class="fa-solid fa-edit"></i></button></a>
                              {!! Form::open(['method'=>'delete', 'id'=>'form_'.$sub_category->id, 'route'=>['sub-category.destroy', $sub_category->id]]) !!}
                              {!! Form::button('<i class="fa-solid fa-trash"></i>', ['type'=>'button', 'data-id'=> $sub_category->id, 'class'=>' delete btn btn-danger btn-sm']) !!}
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