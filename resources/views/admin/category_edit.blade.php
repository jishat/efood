@extends('admin/layout')
@section('page_title', 'Category | eFood')
@section('container')
<div class="row">

<div class="col-md-12">
    <!-- DATA TABLE -->
    <h3 class="title-5 m-b-35">Category / edit / {{$data->id}}</h3>

    <div class="card">
        <div class="card-header">Edit Category</div>
        
        <div class="card-body">
            @if(session('message'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if(session('error_message'))
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Error</span>
                    {{session('error_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <form action="{{route('category.update')}}" method="post">
                @csrf
                <input type="hidden" value="{{$data->id}}" name="id">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="category_name" class="control-label mb-1">Category (in English)</label>
                            <input id="category_name" value="{{$data->category_name}}" name="category_name" type="text" class="form-control"  placeholder="Category name">
                            @error('category_name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="category_name_bn" class="control-label mb-1">Category (in Bangla)</label>
                            <input id="category_name_bn" value="{{$data->category_name_bn}}" name="category_name_bn" type="text" class="form-control"  placeholder="Category name">
                            @error('category_name_bn')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        
                        <div class="form-group">
                            <label for="category_slug" class="control-label mb-1">Slug</label>
                            <input id="category_slug" value="{{$data->category_slug}}" name="category_slug" type="text" class="form-control" placeholder="category slug">
                            @error('category_slug')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        Update</button>
                </div>
            </form>
        </div>
    </div>


</div>
</div>
@endsection