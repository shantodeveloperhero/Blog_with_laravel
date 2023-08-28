@extends('backend.layouts.master')
@section('page_title', 'Users')
@section('page_sub_title', 'List')
@section('content')
    
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">User List</h5>
            <a href="{{ route('users.create') }}"><button class="btn btn-success" class="float-end">Add</button></a>
          </div>
          <div class="card-body">
                 <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead class="table-light">
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @php
                            $sl = 1
                        @endphp
                        @foreach ($users as $user)
                        <tr>
                          <td>{{ $sl++ }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td> 
                            @foreach ($user->roles as $role)
                              {{ $role->name }} {{ !$loop->last ? ', ' : ''  }}
                            @endforeach
                          </td>
                          
                          <td>
                            <div class="d-flex justify-content-center">
                              <a href="{{ route('users.show', $user->id) }}"> <button class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button></a>
                              <a href="{{ route('users.edit', $user->id) }}"> <button class="btn btn-warning btn-sm mx-1"><i class="fa-solid fa-edit"></i></button></a>
                              {!! Form::open(['method'=>'delete', 'id'=>'form_'.$user->id, 'route'=>['users.destroy', $user->id]]) !!}
                              {!! Form::button('<i class="fa-solid fa-trash"></i>', ['type'=>'button', 'data-id'=> $user->id, 'class'=>' delete btn btn-danger btn-sm']) !!}
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