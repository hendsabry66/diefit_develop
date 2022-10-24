@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.subscriptionOrders')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('subscriptionOrders.index')}}"> @lang('admin.subscriptionOrders')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.subscriptionOrders')
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
                            <p><span>@lang('admin.username') :- </span>  {{$order->user->name}}</p>
                            <p><span>@lang('admin.status') :- </span>  {{$order->status->getTranslations('name')['ar']}}</p>
{{--                            <p><span>@lang('admin.address') :- </span>  {{$order->address->city->name}} - {{$order->address->address}} - {{$order->address->house}}</p>--}}
                            <p><span>@lang('admin.total_price') :- </span>  {{$order->subscriptionPrice->price}}</p>
{{--                            <p><span>@lang('admin.price') :- </span>  {{$order->price}}</p>--}}
{{--                            <p><span>@lang('admin.delivery') :- </span>  {{$order->delivery}}</p>--}}
{{--                            <p><span>@lang('admin.tax') :- </span>  {{$order->tax}}</p>--}}
{{--                            <p><span>@lang('admin.delivery_date') :- </span>  {{$order->delivery_date}}</p>--}}
{{--                            <p><span>@lang('admin.delivery_time') :- </span>  {{$order->delivery_time}}</p>--}}
                            <p><span>@lang('admin.payment') :- </span>  {{$order->payment}}</p>
                            <h6>@lang('admin.orderItems')</h6>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th> اليوم </th>
                                    <th>نوع الوجبه  </th>
                                    <th>الوجبات  </th>
{{--                                    <th>  </th>--}}
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($order->subscriptionOrderFood as $item)
                                    <tr>
                                        <td>{{$item->day}}</td>
                                        <td>{{$item->foodType->getTranslations('name')['ar'] }}</td>
                                        <td>{{$item->food->getTranslations('name')['ar'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{route('subscriptionOrders.edit',$order->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
