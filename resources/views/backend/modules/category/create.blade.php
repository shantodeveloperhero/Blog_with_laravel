@extends('backend.layouts.master')
@section('page_title', 'Category')
@section('page_sub_title', 'Create')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Category</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add New Category</h5>
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
                  <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                   
                   {!! Form::label('name', 'Name') !!}
                   {!! Form::text('name', null, ['id'=>'name','class'=>'form-control', 'placeholder'=>'Enter Category Name']) !!}
                   {!! Form::label('slug', 'Slug', ['class'=>'mt-2']) !!}
                   {!! Form::text('slug', null, ['id'=>'slug','class'=>'form-control', 'placeholder'=>'Enter Category Slug']) !!}
                   {!! Form::label('order_by', 'Category Serial', ['class'=>'mt-2']) !!}
                   {!! Form::number('order_by', null, ['class'=>'form-control', 'placeholder'=>'Enter Category Serial']) !!}
                   {!! Form::label('status', 'Category Status', ['class'=>'mt-2']) !!}
                   {!! Form::select('status', [0=>'Active'], null, ['class'=>'form-select', 'placeholder'=>'Select Category Status']) !!}
                   {!! Form::button('Create Category', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}
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
