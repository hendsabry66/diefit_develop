@extends('web.layouts.master')
@section('content')

    <div class="intro">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="content">
                        <h1>الإشتراكات</h1>
                        <p>انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع
                            بالنتائج </p>
                        <a href="" class="btn btn-warning">المزيد</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure>
                        <img class="bg-image" src="{{asset('web/assets/images/Shape-423.png')}}" alt="">
                        <img src="{{asset('web/assets/images/img-slider.png')}}" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <div class="package">
        <div class="container">
            <div class="row">
                @foreach($subscriptions as $subscription)
                    <div class="col-lg-4 col-md-6">
                        <div class="item one-package-item">
                            <h2>{{$subscription->name}}</h2>
                            <div class="desc">
                                <p class="mb-0">
                                    {!! strip_tags($subscription->details) !!}
                                </p>
                            </div>

                            <hr>
                            <p> @lang('web.period'): <strong>{{$subscription->period}} @lang('web.days')</strong></p>

                            <div class="d-package">
                                <ul class="change-package">
                                    @foreach($subscription->subscriptionPrices as $key=>$subscriptionPrice)
                                        <li id ="{{$subscriptionPrice->id}}" data-price="{{$subscriptionPrice->price}}">
                                            @if($key == 0)
                                                <span class="on"><i class="fa-solid fa-check"></i></span>
                                            @else
                                                <span></span>
                                            @endif

                                            @foreach(json_decode($subscriptionPrice->food_type) as $foodType)
                                                {{\App\Models\FoodType::find($foodType)->name}} ,
                                            @endforeach

                                        </li>
                                    @endforeach
                                    {{--                                <li><span class="on"><i class="fa-solid fa-check"></i></span>وجبة واحدة</li>--}}
                                    {{--                                <li><span></span>وجبتين</li>--}}
                                    {{--                                <li><span></span>كامل الوجبات</li>--}}
                                </ul>
                                {{--  <ul>--}}
                                {{--    @foreach($types as $type)--}}
                                {{--       <li><span></span> {{$type->name}} </li>--}}
                                {{--   @endforeach--}}

                                {{--   </ul>--}}
                            </div>


                            <hr>
                            <div class="text-center">
                                 <form action="{{url('/subscriptions/subscriptionOrder')}}" method="get">
                                    <input type="hidden" name="subscription_id" value="{{$subscription->id}}">
                                    <input type="hidden" id="sub" name="subscription_price_id" value="{{$subscription->subscriptionPrices()->first()->id}}">
                                    <input type="hidden" name="delivery_cost" class="input-delivery-cost" value="{{$subscription->id}}">

                                     <select name="type_id">
                                         @foreach(types($subscription->food_type) as $type)
                                             <option value="{{$type->id}}" data-price="{{$type->price}}">{{$type->value}}{{$subscription->food_type}}</option>
                                         @endforeach
                                     </select>
                                     <select name="days">

                                             <option value="5">5 days</option>
                                             <option value="7">7 days</option>
                                             <option value="14">14 days</option>
                                             <option value="28">28 days</option>

                                     </select>
{{--                                    <input type="number" name="specialist_session_number" value="" placeholder="{{__('web.specialist_session_number')}}">--}}
                                     <select name="delivery_cost" class="change-area">
                                        <option value="">-- @lang('web.choose_delivery_city') --</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->delivery_cost}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    
                                     <p> @lang('web.specialist_price'): <strong>{{$subscription->specialist_price}} @lang('web.ryal')</strong></p>
                                     <p>   @lang('web.delivery_cost') : <strong class="update-delivery-cost">0 @lang('web.ryal')</strong></p>

                                     <div class="price">
                                        <div class="d-flex">
                                            <span class="updated-price">{{$subscription->subscriptionPrices()->first()->price}}</span>
                                            <span>ريال
                                    <br>سعودي</span>
                                        </div>
                                    </div>
                                    <button type="submit"  class="btn btn-outline-warning">@lang('web.subscription') </button>
                                </form>
                                {{--                                <a href="{{url('/subscriptions/subscriptionOrder/'.$subscription->subscriptionPrices()->first()->id)}}" id="sub" class="btn btn-outline-warning" > اشتراك</a>--}}


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection


