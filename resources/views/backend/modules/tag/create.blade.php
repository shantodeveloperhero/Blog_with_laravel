@extends('backend.layouts.master')
@section('page_title', 'Tag')
@section('page_sub_title', 'Create')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Tag</h4>

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
            <form action="{{ route('tag.store') }}" method="POST">
                @csrf
                {!! Form::label('name', 'Name') !!}
                   {!! Form::text('name', null, ['id'=>'name','class'=>'form-control', 'placeholder'=>'Enter Tag Name']) !!}
                   {!! Form::label('slug', 'Slug', ['class'=>'mt-2']) !!}
                   {!! Form::text('slug', null, ['id'=>'slug','class'=>'form-control', 'placeholder'=>'Enter Tag Slug']) !!}
                   {!! Form::label('order_by', 'Tag Serial', ['class'=>'mt-2']) !!}
                   {!! Form::number('order_by', null, ['class'=>'form-control', 'placeholder'=>'Enter Tag Serial']) !!}
                   {!! Form::label('status', 'Tag Status', ['class'=>'mt-2']) !!}
                   {!! Form::select('status', [0=>'Active'], null, ['class'=>'form-select', 'placeholder'=>'Select Tag Status']) !!}
                   {!! Form::button('Create Tag', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}
  
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
