@extends('backend.layouts.master')
@section('page_title', 'Users')
@section('page_sub_title', 'Create')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add User</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add New User</h5>
            <small class="text-muted float-end">Input Information</small>
          </div>
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
                <div class="card-body">
                  <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                   
                   {!! Form::label('name', 'Name') !!}
                   {!! Form::text('name', null, ['id'=>'name','class'=>'form-control', 'placeholder'=>'Enter User Name']) !!}
                   {!! Form::label('email', 'Email') !!}
                   {!! Form::text('email', null, ['id'=>'email','class'=>'form-control', 'placeholder'=>'Enter Email Name']) !!}
                   <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                   </div>
                  
                   <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
                   </div>

                   <div class="form-group">
                    <label for="roles">roles</label>
                    <select class="form-control"  name="role_id" id="">
                        @foreach ($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                   </div>
                  
                  {{--   <div class="form-group">
                    <br>
                    <lebel>Assign Role</lebel>
                    <div class="row">

                    
                    @foreach ($roles as $role)
                    <div class="col-lg-3">
                      <div class="checkbox">
                        <label for=""><input type="checkbox" name="role[]" value="{{ $role->id }}">{{ $role->name }}</label>
                      </div>
                    </div>
                    @endforeach
                   
                  </div>

                  </div> --}}
                   {!! Form::button('Create Users', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}
                </form>
                </div>
            
          </div>
        </div>
      </div>
</div>


  @push('js')
  <script>
    $('#name').on('input', function(){
        let name= $(this).val()
        let slug = name.replaceAll(' ', '-')
        $('#slug').val(slug.toLowerCase());
    })
</script>
  @endpush

@endsection