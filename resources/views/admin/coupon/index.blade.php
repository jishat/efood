@extends('admin/layout')
@section('page_title', 'Coupon | eFood')
@section('coupon_select', 'active')
@section('container')
    <div class="row">

        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="d-flex justify-content-between align-items-start">
                <h3 class="title-5 m-b-35">Coupon</h3>
                <a href="{{url('admin/coupon/create')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>add coupon</button></a>
                
            </div>
            @if(session('message'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show mt-3">                        
                        <span class="badge badge-pill badge-success">Success</span>
                        {{session('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
            
            
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
                            <th>Id</th>
                            <th>Name</th>
                            <th>Name (Bangla)</th>
                            <th>Coupon code</th>
                            <th>Coupon method</th>
                            <th>Coupon value</th>
                            <th>Coupon quantity</th>
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
                            <td>{{$list->coupon_name}}</td>
                            <td>{{$list->coupon_name_bn}}</td>
                            <td>
                                <span class="block-email">{{$list->coupon_code}}</span>
                            </td>
                            <td>{{$list->coupon_method}}</td>
                            <td>{{$list->coupon_value}}</td>
                            <td>{{$list->coupon_quantity}}</td>
                            <td>
                                <div class="table-data-feature">
                                    <a href="coupon/edit/{{$list->id}}" class="mr-2">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button></a>
                                    <a href="coupon/destroy/{{$list->id}}"><button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
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