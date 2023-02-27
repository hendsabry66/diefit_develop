@extends('web.layouts.master')
@section('title')
|
    @lang('web.order_details')
@endsection
@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('web.home')</a></li>
                <li class="breadcrumb-item"><a href="{{url('/store/orders')}}"> @lang('web.orders')</a></li>
                <li class="breadcrumb-item"><a href="#"> # {{$order->id}}</a></li>
            </ol>
        </nav>
    </div>

    <div class="products single-product store-order-inner mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="content mt-4 mt-md-0">
                        <div class="info-order">
                            <ul>
                                <li>رقم الطلب: <strong>{{$order->id}}</strong></li>
                                <li>حالة الطلب: <strong><span class="sucsses">{{$order->status->name}}</span></strong></li>
                            </ul>
                        </div>
                        <h1> قائمة المنتجات </h1>
                        @foreach($order_items as $order_item)
                            <div class="head">
                                <img src="{{$order_item->product->image}}">
                                <h2>{{$order_item->product->name}}</h2>

                                <ul>
                                    <li class="mb-4">
                                    @foreach(json_decode($order_item->specification) as $key=>$specification)
                                           @lang('web.'.$key) :- {{$specification}} -
                                        @endforeach
                                    </li>
                                    <li class="mb-4">الكمية: <strong>{{$order_item->quantity}}</strong></li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
      @endsection
