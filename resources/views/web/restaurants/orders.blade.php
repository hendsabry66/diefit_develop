@extends('web.layouts.master')
@section('title')
    |
    @lang('web.orders')
@endsection
@section('content')

    <div class="notification store-order">
        <div class="container">
            <div class="head text-center">
                <h2>طلباتي</h2>
            </div>
            @foreach($orders as $order)

                <div class="item mb-4">
                    <div class="d-md-flex">

                        {{--                    <figure>--}}
                        {{--                        <a href="{{url('store/orderDetails/'.$order->id)}}"> <img src="{{$order->orderItems()->first()->product->image}}" alt=""> </a>--}}
                        {{--                    </figure>--}}
                        <div class="caption">
                            <div class="d-md-flex info">
                                <div>
                                    <ul>
                                        <a href="{{url('restaurant/orderDetails/'.$order->id)}}">
                                            <li>رقم الطلب: <strong>{{$order->id}}</strong></li>
                                        </a>
                                        <li>حالة الطلب: <strong> {{$order->status->name}}</strong></li>
                                        {{--                                    <li>اسم المنتج: <strong> {{$order->orderItems()->first()->product->name}}</strong></li>--}}
                                        {{--                                    <li>الكمية: <strong> {{$order->orderItems()->first()->quantity}}</strong></li>--}}
                                    </ul>
                                </div>
                                <div>
                                    <ul>
{{--                                        <li>طريقة الدفع المحددة: <strong>{{$order->payment}}</strong></li>--}}
                                        <li>
                                            العنوان المحدد في الطلب: <strong>

                                                {{(!empty($order->address->city_id)) ? $order->address->city->name : ''}} , {{$order->address->address}},
                                                {{$order->address->street}} , {{$order->address->house}} ,
                                                {{$order->address->apartment}}
                                            </strong>
                                        </li>
                                        <li>مجمل الفاتورة: <strong>{{$order->total_price}}  </strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <a href="{{url('restaurant/deleteOrder/'.$order->id)}}"><i class="fa-solid fa-xmark"></i></a>--}}
                </div>
            @endforeach

        </div>
    </div>

@endsection
