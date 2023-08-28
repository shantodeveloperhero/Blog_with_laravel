@extends('backend.layouts.master')
@section('page_title', 'Sub Category')
@section('page_sub_title', 'Details')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Sub Category List</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Sub Category Details</h5>
            <small class="text-muted float-end">Sub Category Information</small>
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
                          <td>{{ $subCategory->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $subCategory->name }}</td>
                        </tr>
                          
                          <tr>
                            <th>Slug</th>
                            <td>{{ $subCategory->slug }}</td>
                          </tr>

                          <tr>
                            <th>Category</th>
                            <td>{{ $subCategory->category->name }}</td>
                          </tr>
                          <tr>
                            <th>Status</th>
                            <td>{{ $subCategory->status ==1? 'active': 'inactive' }}</td>
                          </tr>
                          <tr>
                            <th>Order By</th>
                            <td>{{ $subCategory->order_by }}</td>
                          </tr>
                            
                      </tbody>
                      
                    </table>

                    <td>
                      <a href="{{ route('sub-category.index') }}" class="btn btn-success btn-sm mt-2">Back</a>
                  </td>
                  </div>




@endsection