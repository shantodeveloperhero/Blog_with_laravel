@extends('backend.layouts.master')
@section('page_title', 'Role')
@section('page_sub_title', 'Create')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Role</h4>

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
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                   {!! Form::label('name', 'Name') !!}
                   {!! Form::text('name', null, ['id'=>'name','class'=>'form-control', 'placeholder'=>'Enter Role Name']) !!}
                   <div class="row">
                   <div class="col-lg-4">
                       <label for="">Posts Permission</label>
                       @foreach ($permissions as $permission)
                       @if ($permission->for == 'post')
                       <div class="checkbox">
                        <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                        
                       </div>
                         
                       @endif
                         
                       @endforeach
                       
                   </div>
                   <div class="col-lg-4">
                    <label for="">User Permission</label>
                    @foreach ($permissions as $permission)
                       @if ($permission->for == 'user')
                       <div class="checkbox">
                        <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                        
                       </div>
                         
                       @endif
                         
                       @endforeach
                   </div>
                   <div class="col-lg-4">
                    <label for="">Other Permission</label>
                    @foreach ($permissions as $permission)
                       @if ($permission->for == 'other')
                       <div class="checkbox">
                        <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                        
                       </div>
                         
                       @endif
                         
                       @endforeach
                   </div>
                  </div>
                   {!! Form::button('Create Role', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}
  
            </form>
          </div>


          </div>
        </div>
    


  @push('js')
  <script>
    $('#name').on('input', function(){
        let name= $(this).val()
        $('#slug').val(name);
    })
</script>
  @endpush

@endsection