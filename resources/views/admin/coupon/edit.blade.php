@extends('admin/layout')
@section('page_title', 'Coupon | eFood')
@section('container')
<div class="row">

<div class="col-md-12">
    <!-- DATA TABLE -->
    <h3 class="title-5 m-b-35">Coupon / edit / {{$data->id}}</h3>

    <div class="card">
        <div class="card-header">Edit Coupon</div>
        
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

            <form action="{{route('coupon.update')}}" method="post">
                        @csrf
                        <input  name="id" type="hidden" value="{{$data->id}}">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="coupon_name" class="control-label mb-1">Coupon Name</label>
                                    <input id="coupon_name" name="coupon_name" type="text" value="{{$data->coupon_name}}" class="form-control"  placeholder="Coupon name">
                                    @error('coupon_name')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="coupon_name_bn" class="control-label mb-1">Coupon Name (in Bangla)</label>
                                    <input id="coupon_name_bn" name="coupon_name_bn" type="text" value="{{$data->coupon_name_bn}}" class="form-control"  placeholder="Category name">
                                    @error('coupon_name_bn')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                
                                <div class="form-group">
                                    <label for="coupon_code" class="control-label mb-1">Coupon Code</label>
                                    <input id="coupon_code" value="{{$data->coupon_code}}" name="coupon_code" type="text" class="form-control" placeholder="Coupon code">
                                    @error('coupon_code')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                
                                <div class="form-group">
                                    <label for="coupon_method" class="control-label mb-1">Coupon Method</label>
                                    <select name="coupon_method" class="form-control" id="coupon_method">
                                        <option value="cash" {{ $data->coupon_method == 'cash' ? 'selected' : '' }}>cash</option>
                                        <option value="percentage" {{ $data->coupon_method == 'percentage' ? 'selected' : '' }}>percentage</option>
                                    </select>
       
                                    @error('coupon_method')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                
                                <div class="form-group">
                                    <label for="coupon_value" class="control-label mb-1">Coupon Value</label>
                                    <input id="coupon_value" name="coupon_value" type="text" value="{{$data->coupon_value}}" class="form-control" placeholder="Coupon value">
                                    @error('coupon_value')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                
                                <div class="form-group">
                                    <label for="coupon_quantity" class="control-label mb-1">Coupon Quantity</label>
                                    <input id="coupon_quantity" name="coupon_quantity" value="{{$data->coupon_quantity}}" type="text" class="form-control" placeholder="Coupon Quantity">
                                    @error('coupon_quantity')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="coupon_expired" class="control-label mb-1">Coupon Expire Date</label>
                                    <input id="coupon_expired" value="{{date('Y-m-d', strtotime($data->coupon_expired_at))}}" name="coupon_expired" type="date" class="form-control" placeholder="Coupon Expire date">
                                    @error('coupon_expired')
                                    <div class="alert alert-danger" role="alert">
										{{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>add coupon</button>
                        </div>
                        </div>
                        
                    </form>
        </div>
    </div>


</div>
</div>
@endsection