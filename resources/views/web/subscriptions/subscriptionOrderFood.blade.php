@extends('web.layouts.master')
@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="#">الاشتراكات</a></li>
                <li class="breadcrumb-item active" aria-current="page">تأكيد الاشتراك</li>
            </ol>
        </nav>
    </div>


    <div class="my-participation">
        <div class="container">
            <div class="my-participation">
                <div class="container">
                    <div class="head">
                        <h2>اشتراكاتي</h2>
                        <div class="alert alert-info">
                            @lang('web.You can complete or modify meals when the subscription is completed')
                        </div>
                        <div class="mt-4 d-md-flex justify-content-between">

                            <div>
                                <p class="m-0">انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع بالنتائج المزهلة انضم
                                    الينا
                                    واستمتع بالنتائج </p>
                            </div>
                            <div>
                                <span>السعرات المستهدفة</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                           value="option1">
                                    <label class="form-check-label" for="inlineRadio1">1000</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                           value="option2">
                                    <label class="form-check-label" for="inlineRadio2">1500</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                                           value="option3">
                                    <label class="form-check-label" for="inlineRadio3">2000</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4"
                                           value="option3">
                                    <label class="form-check-label" for="inlineRadio4">2500</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5"
                                           value="option3">
                                    <label class="form-check-label" for="inlineRadio5">+3000</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{Session::get('error')}}
                        </div>
                    @endif

                    <form action="{{url('subscriptions/saveOrderFood')}}" method="post">
                        <input type="hidden" name="subscription_order_id" value="{{$subscription_order_id}}">
                        <input type="hidden" name="subscription_id" value="{{$subscription->id}}">
                        @csrf

                        <div class="entry-content d-table">

                            <div class="dt-header">
                                <div class="d-flex">
                                    <div>
                                        <span>الاسبوع الأول</span>
                                    </div>
                                    @if(!empty($food_types))
                                        @foreach($food_types as $key=>$food_type)
                                            <div>
                                                <span>{{$food_type->name}}</span>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div class="d-body">

                                @foreach($dateAndDay as $key=>$value)


                                    <div class="d-rt d-flex">
                                        <div>
                                            <span>{{$value[1]}} <br> {{$value[0]}} </span>
{{--                                            <input type="hidden" name="day[{{$key1}}]" value="{{$key1}}">--}}
                                            <input type="hidden" name="day" value="{{$value[1]}}">
                                            <input type="hidden" name="date" value="{{$value[0]}}">
                                        </div>

{{--                                        @if(count($food_types) != 0)--}}

                                        @foreach($food_types as $food_type)


                                            <div>
{{--                                                <input type="hidden" name="day[{{$key1}}][food_type_id][]" value="{{$key}}">--}}
                                                @foreach($array[$key + 1 ][$food_type->id] as $food)

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="{{$food->id}}"  name="food_day[{{$value[0]}}{{'/'}}{{$value[1]}}][{{$food_type->id}}][food_id][]" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">


                                                            <a target="_blank" href="{{url('restaurant/foodDetails/'.$food->id)}}">{{$food->name}}<img src="{{$food->image}}"></a>
                                                        </label>
                                                    </div>
                                                @endforeach

                                            </div>
                                        @endforeach
{{--                                        @else--}}

{{--                                            @foreach($array[0] as $key=>$food)--}}


{{--                                                <div>--}}
{{--                                                    --}}{{--                                                <input type="hidden" name="day[{{$key1}}][food_type_id][]" value="{{$key}}">--}}
{{--                                                    @foreach($array[$food_type->id] as $food)--}}

{{--                                                        <div class="form-check">--}}
{{--                                                            <input class="form-check-input" type="radio" value="{{$food->id}}"  name="food_day[{{$value[0]}}{{'/'}}{{$value[1]}}][food_id][]" id="flexCheckDefault">--}}
{{--                                                            <label class="form-check-label" for="flexCheckDefault">--}}


{{--                                                                <a target="_blank" href="{{url('restaurant/foodDetails/'.$food->id)}}">{{$food->name}}<img src="{{$food->image}}"></a>--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                    @endforeach--}}

{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}


                                    </div>
                                @endforeach

                            </div>

                        </div>

                        <div class="d-flex links text-md-start text-center justify-content-md-end mt-5">
                            <div>
                                {{--                    <input class="btn btn-outline-dark mb-3 mb-md-0 me-0 me-md-3" type="button"--}}
                                {{--                        value="طلب الغاء اشتراك">--}}
                                <input class="btn btn-warning" type="submit" value="حفظ وإرسال">
                            </div>
                        </div>

                    </form>
                </div>
            </div>


@endsection
