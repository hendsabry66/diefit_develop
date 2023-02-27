@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.storeOrders')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('storeOrders.index')}}"> @lang('admin.storeOrders')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.storeOrders')
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section id="horizontal-form-layouts">
        <div class="row match-height">
            <div class=" col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title"># {{$order->id}}  </h4>
                            <p><span>@lang('admin.order_date') :- </span>  {{$order->created_at}}</p>
                            <p><span>@lang('admin.username') :- </span> <a href="{{url('admin/users/'.$order->user->id)}}"> {{$order->user->name}}</a> </p>
                            <p><span>@lang('admin.phone') :- </span>  {{$order->user->phone}}</p>
                            <p><span>@lang('admin.status') :- </span>  {{$order->status->getTranslations('name')['ar']}}</p>
                            <p><span>@lang('admin.address') :- </span>  {{$order->address->city->name}} - {{$order->address->address}} - {{$order->address->house}}</p>
                            <p><span>@lang('admin.total_price') :- </span>  {{$order->total_price}}  ريال</p>
                            <p><span>@lang('admin.price') :- </span>  {{$order->price}}  ريال</p>
                            <p><span>@lang('admin.delivery') :- </span>  {{$order->delivery}}  ريال</p>
                            <p><span>@lang('admin.tax') :- </span>  {{$order->tax}}  ريال</p>
                            <p><span>@lang('admin.delivery_date') :- </span>  {{$order->delivery_date}}</p>
                            <p><span>@lang('admin.delivery_time') :- </span>  {{$order->delivery_time}}</p>
                            <p><span>@lang('admin.payment') :- </span>  {{$order->payment}}</p>
                            <h6>@lang('admin.orderItems')</h6>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>صورة المنتج </th>
                                    <th>اسم المنتج </th>
                                    <th>الكميه </th>
                                    <th>التكلفه </th>
                                    <th>الاجمالي </th>
                                    <th>الضريبه </th>
                                    <th>الموصفات  </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td><img src="{{$item->product->image}}" width="100"></td>
                                        <td><a href="{{url('ar/productDetails/'.$item->product->id)}}">{{$item->product->getTranslations('name')['ar']}} </a></td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->price}}  ريال</td>
                                        <td>{{$item->price * $item->quantity}}  ريال</td>
                                        <td>{{$order->tax}}  ريال</td>
                                        <td>
                                            @if(!empty(json_decode($item->specification)))
                                                @foreach(json_decode($item->specification) as $key=>$value)
                                                    <p>{{$key}} :- {{$value}}</p>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="float: left">
                                <p>الاجمالي <strong>{{ $item->price * $item->quantity  }}</strong></p>
                                <p>الشحن <strong>{{$order->delivery}}</strong></p>
                                <p>الضريبه <strong>{{$order->tax}}</strong></p>
                                <p>مجموع الطلب  <strong>{{($item->price * $item->quantity) + $order->delivery + $order->tax }}</strong></p>

                            </div>
                            <div style="clear: both"></div>

                            <a href="{{route('storeOrders.edit',$order->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
