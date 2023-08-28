@extends('backend.layouts.master')
@section('page_title', 'Post')
@section('page_sub_title', 'Create')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Add Post</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add New Post</h5>
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
                
            {!! Form::open(['method'=>'post', 'route'=>'post.store', 'files'=>true]) !!}
            @include('backend.modules.post.form')
            {!! Form::button('Create Post', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}   
            {!! Form::close() !!}    



@endsection
