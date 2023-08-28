@extends('backend.layouts.master')
@section('page_title', 'Sub Category')
@section('page_sub_title', 'Edit')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Sub Category</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Sub Category Edit</h5>
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
                
                {!! Form::model($subCategory,['method'=>'put', 'route'=>['sub-category.update', $subCategory->id]]) !!}
                @include('backend.modules.sub_category.form')
                {!! Form::button('Update Sub Category', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}   
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