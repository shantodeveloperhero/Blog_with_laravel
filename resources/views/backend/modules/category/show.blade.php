@extends('backend.layouts.master')
@section('page_title', 'Category')
@section('page_sub_title', 'Details')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Category List</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Category Details</h5>
            <small class="text-muted float-end">Category Information</small>
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
                <div class="table-responsive text-nowrap">
                    <table class="table">
                      <tbody class="table-light">
                        <tr>
                          <th>SL</th>
                          <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                          
                          <tr>
                            <th>Slug</th>
                            <td>{{ $category->slug }}</td>
                          </tr>
                          <tr>
                            <th>Status</th>
                            <td>{{ $category->status ==1? 'active': 'inactive' }}</td>
                          </tr>
                          <tr>
                            <th>Order By</th>
                            <td>{{ $category->order_by }}</td>
                          </tr>
                            
                      </tbody>
                      
                    </table>

                    <td>
                      <a href="{{ route('category.index') }}" class="btn btn-success btn-sm mt-2">Back</a>
                  </td>
                  </div>




@endsection