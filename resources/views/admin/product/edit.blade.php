@extends('admin/layout')
@section('page_title', 'Product | eFood')
@section('container')
    <div class="row">

        <div class="col-md-12">
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35">Product</h3>

            <div class="card">
                <div class="card-header">Edit Product</div>
                
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
                    

                    <form action="{{route('product.update')}}" method="post" enctype = "multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$data->id}}" name="id">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="product_name" class="control-label mb-1">Product Name  (in English)</label>
                                    <input id="product_name" name="product_name" type="text" value="{{$data->product_name}}" class="form-control"  placeholder="Product name">
                                    @error('product_name')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="product_name_bn" class="control-label mb-1">Product Name (in Banlga)</label>
                                    <input id="product_name_bn" value="{{$data->product_name_bn}}" name="product_name_bn" type="text" class="form-control"  placeholder="Product name">
                                    @error('product_name_bn')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="product_slug" class="control-label mb-1">Product Slug</label>
                                    <input id="product_slug" name="product_slug" type="text" value="{{$data->product_slug}}" class="form-control"  placeholder="Product slug">
                                    @error('product_slug')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="product_img" class="control-label mb-1">Product Image</label>
                                    <input id="product_img" name="product_img" type="file" class="form-control"  placeholder="Product image">
                                    @error('product_img')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="product_price" class="control-label mb-1">Product price</label>
                                    <input id="product_price" name="product_price" type="text" class="form-control" value="{{$data->product_price}}"  placeholder="Product price">
                                    @error('product_price')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
   
                            <div class="col-4">
                                
                                <div class="form-group">
                                    <label for="category_id" class="control-label mb-1">Category</label>
                                    <select name="category_id" class="form-control" id="category">
                                        <option disabled selected>Select category</option>
                                        @foreach($categories as $list)
                                            <option {{$data->category_id == $list->id ? 'selected':''}} value="{{$list->id}}">{{$list->category_name}}</option>
                                        @endforeach
                                    </select>
       
                                    @error('category')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            add product</button>
                        </div>
                        </div>
                        
                    </form>
                </div>
            </div>

            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection