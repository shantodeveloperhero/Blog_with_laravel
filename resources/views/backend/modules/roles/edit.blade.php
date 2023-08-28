@extends('backend.layouts.master')
@section('page_title', 'Role')
@section('page_sub_title', 'Edit')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Role Edit</h5>
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
                
                {!! Form::model($role,['method'=>'put', 'route'=>['roles.update', $role->id]]) !!}
                @include('backend.modules.roles.form')
                {!! Form::button('Update Role', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}   
                {!! Form::close() !!}          
            
          </div>
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