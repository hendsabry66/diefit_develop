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

                            @php
                                $ids = array_unique(\App\Models\SubscriptionFood::where('subscription_id',$subscription->id)->where('food_type_id','!=',0)->pluck('food_type_id')->toArray());
                                $foodTypes = \App\Models\FoodType::whereIn('id',$ids)->get();
                            @endphp
                            @if(!empty($foodTypes))
                            <div class="d-package">
                                <ul class="change-package">

                                    @foreach($foodTypes as $foodType)
                                    <li><span class="on"><i class="fa-solid fa-check"></i></span> {{$foodType->name}}</li>
                                    @endforeach
                                </ul>

                            </div>
                            @endif
                            <br>
                            <hr>

                            <div class="text-center one-pack-itme">
                                <form action="{{url('/subscriptions/subscriptionOrder')}}" method="get">
                                    <input type="hidden" name="subscription_id" value="{{$subscription->id}}">
                                    <p> @lang('web.period') </p>
                                    <select name="subscription_delivery_id" >
                                        <option value="">-- مده التوصيل  --</option>
                                        @foreach($subscription->subscriptionDelivery as  $subscriptionDelivery)
                                            <option value="{{$subscriptionDelivery->id}}" >{{$subscriptionDelivery->period}} <span> يوم </span></option>
                                        @endforeach
                                    </select>
                                    <br>

                                    @if($subscription->has_calories == 1)
                                        <p> السعرات الحراريه  </p>
                                        <select name="calories" >
                                            <option value="">--  السعرات الحراريه  --</option>
                                            @foreach(json_decode($subscription->calories) as  $calorie)
                                                <option value="{{$calorie}}" >{{$calorie}}<span> سعر حراري</span></option>
                                            @endforeach
                                        </select>
<br>
                                    @endif
                                    <input type="radio" name="delivery" value="1"><label>توصيل</label>
                                    <input type="radio" name="delivery" value="0"><label>بدون توصيل </label>
                                    <br>
                                    <p>  المدينه  </p>
                                    <select name="delivery_cost" class="change-area">
                                        <option value="">-- @lang('web.choose_delivery_city') --</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->delivery_cost}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    @if($subscription->has_specialist == 1)
                                       <input name="specialist_session_number" value="" placeholder="عدد الجلسات مع المختص ">
                                        <br>
                                    @endif
{{--                                    <input type="hidden" id="sub" name="subscription_price_id" value="{{$subscription->subscriptionPrices()->first()->id}}">--}}
{{--                                    <input type="hidden" id="subscription_price" name="subscription_price" value="{{$subscription->subscriptionPrices()->first()->price}}">--}}
                                    {{--     <input type="hidden" name="delivery_cost" class="input-delivery-cost" value="{{$subscription->id}}"> --}}
{{--                                    <label>@lang('web.'.$subscription->food_type)</label>--}}
{{--                                    <select name="type_id" class="change-type">--}}
{{--                                        @foreach(types($subscription->food_type) as $type)--}}
{{--                                            <option value="{{$type->id}}" data-price="{{$type->price}}">{{$type->value}}{{$subscription->food_type}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    <label>@lang('web.days')</label>--}}
{{--                                    <select name="days" class="change-days">--}}
{{--                                        <option value="5">5 days</option>--}}
{{--                                        <option value="7">7 days</option>--}}
{{--                                        <option value="14">14 days</option>--}}
{{--                                        <option value="28">28 days</option>--}}

{{--                                    </select>--}}
                                    {{--                                    <input type="number" name="specialist_session_number" value="" placeholder="{{__('web.specialist_session_number')}}">--}}

                                    <div class="price">
                                        <div class="d-flex">
                                            <span class="updated-price">{{$subscription->price}}</span>
                                            <span>ريال
                                    <br>سعودي</span>
                                        </div>
                                    </div>
                                    {{-- <p> @lang('web.specialist_price'): <strong>{{$subscription->specialist_price}} @lang('web.ryal')</strong></p> --}}
                                    <p>   @lang('web.delivery_cost') : <strong class="update-delivery-cost">0 @lang('web.ryal')</strong></p>
                                    @if($subscription->has_specialist == 1)
                                        <p><span>سعر المختص للجلسه </span>{{$subscription->specialist_price_for_session}}</p>
                                        <p><span>  عدد الجلسات المقترحه  </span>{{$subscription->suggested_session_number}}</p>
                                    @endif


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


