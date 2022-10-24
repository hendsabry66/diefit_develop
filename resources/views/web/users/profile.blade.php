@extends('web.layouts.master')
@section('title', 'Code')
@section('content')

    <div class="entry-content profile">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-4">
                    <header class="text-center">
                        @if(!empty($user->image))
                            <figure class="image"><img src="{{$user->image}}" alt=""></figure>

                        @else
                            <figure class="image"><img src="{{url('web/assets/images/user.jpg')}}" alt=""></figure>
                        @endif
                        <h2>{{$user->name}} </h2>
                        <div class="information">
                            <div class="mb-3">
                                <span><i class="fa-solid fa-phone-flip"></i></span> <span>{{$user->phone}}</span>
                            </div>
                            <div class="mb-3">
                                <span><i class="fa-solid fa-envelope"></i></span> <span>{{$user->email}}</span>
                            </div>
                        </div>
                        <a href="{{url('additionalData')}}" class="btn btn-success"> @lang('web.extra_data')</a>
                    </header>
                </div>
            </div>
            <div class="boxs">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="item text-center mb-4">
                            <a href="{{url('/store/orders')}}">
                                <figure><img src="{{asset('web')}}/assets/images/profile-icon01.png" alt=""></figure>
                                <h3>@lang('web.The_number_of_user_orders_from_the_store')</h3>
                                <small>{{$storeOrders}}</small>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="item text-center mb-4">
                            <a href="{{url('store/compelete/orders')}}">
                                <figure><img src="{{asset('web')}}/assets/images/profile-icon02.png" alt=""></figure>
                                <h3>@lang('web.The_number_of_completed_orders_from_the_store')</h3>
                                <small>{{$storeOrdersCompleted}}</small>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="item text-center mb-4">
                            <a href="{{url('restaurant/orders')}}">
                                <figure><img src="{{asset('web')}}/assets/images/profile-icon03.png" alt=""></figure>
                                <h3>@lang('web.The_number_of_user_orders_from_the_restaurant')</h3>
                                <small>{{$restaurantOrders}}</small>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="item text-center mb-4">
                            <a href="{{url('restaurant/compelete/orders')}}">
                                <figure><img src="{{asset('web')}}/assets/images/profile-icon04.png" alt=""></figure>
                                <h3>@lang('web.The_number_of_completed_orders_from_the_restaurant')</h3>
                                <small>{{$restaurantOrdersCompleted}}</small>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="item text-center mb-4">
                            <a href="{{url('/subscriptions')}}">
                                <figure><img src="{{asset('web')}}/assets/images/profile-icon05.png" alt=""></figure>
                                <h3>@lang('web.Current_subscription_if_any')</h3>
                                <small> {{$currentSubscription}}</small>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="item text-center mb-4">
                            <a href="#">
                                <figure><img src="{{asset('web')}}/assets/images/profile-icon06.png" alt=""></figure>
                                <h3>@lang('web.Number_of_days_left_in_the_current_subscription')</h3>
                                <small>{{$remainingdays}} @lang('web.days')</small>
                            </a>
                        </div>
                    </div>
{{--                    <div class="col-md-3 col-6">--}}
{{--                        <div class="item text-center mb-4">--}}
{{--                            <a href="">--}}
{{--                                <figure><img src="{{asset('web')}}/assets/images/profile-icon07.png" alt=""></figure>--}}
{{--                                <h3>عدد الاستشارات من خلال المنصة</h3>--}}
{{--                                <small>7</small>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-3 col-6">--}}
{{--                        <div class="item text-center mb-4">--}}
{{--                            <a href="">--}}
{{--                                <figure><img src="{{asset('web')}}/assets/images/profile-icon08.png" alt=""></figure>--}}
{{--                                <h3>عدد الاستشارات المكتملة من خلال المنصة</h3>--}}
{{--                                <small>25</small>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

    @endsection
