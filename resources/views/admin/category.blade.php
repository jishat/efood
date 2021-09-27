@extends('admin/layout')
@section('page_title', 'Category | eFood')
@section('category_select', 'active')
@section('container')
    <div class="row">

        <div class="col-md-12">
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35">Category</h3>

            <div class="card">
                <div class="card-header">Add Category</div>
                
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

                    <form action="{{route('category.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="category_name" class="control-label mb-1">Category (in English)</label>
                                    <input id="category_name" name="category_name" type="text" class="form-control"  placeholder="Category name">
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
                                    <input id="category_name_bn" name="category_name_bn" type="text" class="form-control"  placeholder="Category name">
                                    @error('category_name_bn')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                
                                <div class="form-group">
                                    <label for="category_slug" class="control-label mb-1">Slug (in English)</label>
                                    <input id="category_slug" name="category_slug" type="text" class="form-control" placeholder="category slug">
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
                        <i class="zmdi zmdi-plus"></i>add category</button>
                        </div>
                    </form>
                </div>
            </div>
     
            
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead class="bg-info">
                        <tr>
                            <th>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </th>
                            <th>id</th>
                            <th>name</th>
                            <th>name (Bangla)</th>
                            <th>slug</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr class="tr-shadow">
                            <td>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </td>
                            <td>{{$list->id}}</td>
                            <td>{{$list->category_name}}</td>
                            <td>{{$list->category_name_bn}}</td>
                            <td>
                                <span class="block-email">{{$list->category_slug}}</span>
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="category/edit/{{$list->id}}" class="mr-2">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button></a>
                                    <a href="category/destroy/{{$list->id}}"><button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button></a>
                                    
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection