@extends('admin/layout')
@section('page_title', 'Coupon | eFood')
@section('container')
    <div class="row">

        <div class="col-md-12">
            <!-- DATA TABLE -->
            <h3 class="title-5 m-b-35">Coupon</h3>

            <div class="card">
                <div class="card-header">Add Coupon</div>
                
                <div class="card-body">
                    

                    <form action="{{route('coupon.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="coupon_name" class="control-label mb-1">Coupon Name</label>
                                    <input id="coupon_name" name="coupon_name" type="text" class="form-control"  placeholder="Coupon name">
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
                                    <input id="coupon_name_bn" name="coupon_name_bn" type="text" class="form-control"  placeholder="Category name">
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
                                    <input id="coupon_code" name="coupon_code" type="text" class="form-control" placeholder="Coupon code">
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
                                        <option value="cash">cash</option>
                                        <option value="percentage">percentage</option>
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
                                    <input id="coupon_value" name="coupon_value" type="text" class="form-control" placeholder="Coupon value">
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
                                    <input id="coupon_quantity" name="coupon_quantity" type="text" class="form-control" placeholder="Coupon Quantity">
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
                                    <input id="coupon_expired" name="coupon_expired" type="date" class="form-control" placeholder="Coupon Quantity">
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

            <!-- END DATA TABLE -->
        </div>
    </div>
@endsection