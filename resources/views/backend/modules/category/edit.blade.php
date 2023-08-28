@extends('backend.layouts.master')
@section('page_title', 'Category')
@section('page_sub_title', 'Edit')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Category</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Category Edit</h5>
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
                
                {!! Form::model($category,['method'=>'put', 'route'=>['category.update', $category->id]]) !!}
                @include('backend.modules.category.form')
                {!! Form::button('Update Category', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}   
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