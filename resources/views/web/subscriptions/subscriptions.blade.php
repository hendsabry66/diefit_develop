@extends('web.layouts.master')
@section('content')
    <style>
        .form-control, .form-select {
            min-height: 45px;
        }
    </style>
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
                        <div class="item one-package-item mb-4">
                            <h2>{{$subscription->name}}</h2>
                            <div class="desc">
                                <p class="mb-0">
                                    {!! Str::limit(strip_tags($subscription->details),100)!!}
                                </p>
                            </div>

                            <hr>
                            <form action="{{url('/subscriptions/subscriptionOrder')}}" method="get">



                                @php
                                    $ids = array_unique(\App\Models\SubscriptionFood::where('subscription_id',$subscription->id)->where('food_type_id','!=',0)->pluck('food_type_id')->toArray());
                                    $foodTypes = \App\Models\FoodType::whereIn('id',$ids)->get();
                                @endphp
                                @if(!empty($foodTypes))
                                    <div class="d-package mb-3">
                                        <ul class="change-package">

                                            @foreach($foodTypes as $foodType)
                                                <li><span class="on"><i class="fa-solid fa-check"></i></span> {{$foodType->name}}</li>
                                            @endforeach
                                        </ul>

                                    </div>
                                @endif

                                <div class="one-pack-itme">
                                    <input type="hidden" name="subscription_id" value="{{$subscription->id}}">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: 800">  عدد الوجبات  </label>
                                        <select name="meals" class="form-select">
                                            <option value="">--   عدد الوجبات   --</option>
                                            <option value="1">وجبه</option>
                                            <option value="2">وجبتين</option>
                                            <option value="3">تلات وجبات </option>

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="font-weight: 800"> @lang('web.period') </label>
                                        <select name="subscription_delivery_id" class="form-select select-period">
                                            <option value="">-- مده التوصيل  --</option>
                                            @foreach($subscription->subscriptionDelivery as  $subscriptionDelivery)
                                                <option value="{{$subscriptionDelivery->id}}" data-period-days="{{$subscriptionDelivery->period}}" >{{$subscriptionDelivery->period}} <span> يوم </span></option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if($subscription->has_calories == 1)
                                        <div class="mb-3">
                                            <label class="form-label" style="font-weight: 800"> السعرات الحراريه </label>
                                            <select name="calories" class="form-select select-calorie">
                                                <option value="">--  السعرات الحراريه  --</option>
                                                @foreach(json_decode($subscription->calories) as  $calorie)
                                                    <option value="{{$calorie}}">{{$calorie}}<span> سعر حراري</span></option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <label class="form-label" style="font-weight: 800">  عدد الجرامات  </label>
                                            <select name="grams" class="form-select select-gram">
                                                <option value="">--  عدد الجرامات    --</option>
                                                @foreach(json_decode($subscription->grams) as  $key=>$gram)
                                                    <option value="{{$key}}">{{$gram}}<span>  جرام</span></option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" style="font-weight: 800">   السناكس  </label>
                                            <select name="snacks[]" class="form-select select-gram" multiple>
                                                <option value="">--   السناكس    --</option>

                                                @foreach($subscription->subscriptionSnack as  $subscriptionSnack)
                                                    <option value="{{$subscriptionSnack->price}}">{{$subscriptionSnack->food->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    @endif
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input select-delivery" name="delivery" value="1" id="delivery1"><label class="form-check-label" for="delivery1">توصيل</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input select-delivery" name="delivery" value="0" id="delivery2" checked><label class="form-check-label" for="delivery2">بدون توصيل </label>
                                        </div>
                                    </div>

                                    <div class="mb-3 list-cities" style="background: #f7f7f7;padding: 15px;border-radius: 10px; display: none">
                                        <label class="form-label" style="font-weight: 800"> المدينة </label>
                                        <select name="delivery_cost" class="change-area form-select">
                                            <option value="">-- @lang('web.choose_delivery_city') --</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->delivery_cost}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if($subscription->has_specialist == 1)
                                        <div class="mb-3">
                                            <label class="form-label" style="font-weight: 800"> عدد الجلسات مع المختص </label>
                                            <input class="form-control specialist_session_number" name="specialist_session_number" value="" placeholder="عدد الجلسات مع المختص ">
                                        </div>
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
                                    <hr>
                                    {{-- <p> @lang('web.specialist_price'): <strong>{{$subscription->specialist_price}} @lang('web.ryal')</strong></p> --}}
                                    <p>   @lang('web.delivery_cost') : <strong class="update-delivery-cost">0 @lang('web.ryal')</strong></p>
                                    @if($subscription->has_specialist == 1)
                                        <p><span>سعر المختص للجلسه </span>{{$subscription->specialist_price_for_session}}</p>
                                        <p><span>  عدد الجلسات المقترحه  </span>{{$subscription->suggested_session_number}}</p>
                                    @endif


                                    <div class="text-center">
                                        @if($subscription->has_specialist == 1)
                                            <input type="hidden" id="specialist_price" name="specialist_price" value="{{$subscription->specialist_price_for_session}}">
                                        @else
                                            <input type="hidden" id="specialist_price" name="specialist_price" value="0">
                                        @endif
                                        <input type="hidden" id="subscription_price" name="subscription_price" value="{{$subscription->price}}">
                                        <button type="submit"  class="btn btn-outline-warning submitSubscription">@lang('web.subscription') </button>
                                    </div>
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


