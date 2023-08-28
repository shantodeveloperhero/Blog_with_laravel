@extends('backend.layouts.master')
@section('page_title', 'Permission')
@section('page_sub_title', 'Create')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Permission</h4>

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
            <form action="{{ route('permission.store') }}" method="POST">
                @csrf
                {!! Form::label('name', 'Name') !!}
                   {!! Form::text('name', null, ['id'=>'name','class'=>'form-control', 'placeholder'=>'Enter Permission']) !!}
                   <div class="form-group">
                    <label for="for">Permission for</label>
                    <select name="for" id="for" class="form-control">
                      <option selected disabled>Select Permission Role</option>
                      <option value="user">User</option>
                      <option value="post">Post</option>
                      <option value="other">Other</option>
                    </select>
                   </div>
                   {!! Form::button('Create Permission', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}
  
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