@extends('web.layouts.master')
@section('content')

    <div class="entry-content profile consulting_profile data-user">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <header class="text-center">
                        @if(!empty($user->image))
                            <figure class="image"><img src="{{$user->image}}" alt=""></figure>

                        @else
                            <figure class="image"><img src="{{url('web/assets/images/user.jpg')}}" alt=""></figure>
                        @endif
                        <h2 class="mb-1"> {{$user->name}}</h2>
{{--                        <p class="mb-2"><small>استشاري أمراض قلب</small></p>--}}
                        <div class="information mb-4 mt-4">
                            <div class="mb-3 me-3">
                                <span><i class="fa-solid fa-phone-flip"></i></span> <span>{{$user->phone}}</span>
                            </div>
                            <div class="mb-3">
                                <span><i class="fa-solid fa-envelope"></i></span> <span>{{$user->email}}</span>
                            </div>
                        </div>
                    </header>
                </div>
            </div>

            <div class="info" style="line-height: 2">
                <div class="head" style="color: #f47121;">
                    <h2>@lang('web.extra_data')</h2>
                </div>
{{--                <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل--}}
{{--                    الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى--}}
{{--                    المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي--}}
{{--                    أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في--}}
{{--                    الصفحة التي يقرأها هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن--}}
{{--                    التركيز على الشكل الخارجي</p>--}}
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form">
                        <form action="{{url('updateAdditionalData')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-3" for=""><strong>@lang('web.age')</strong></label>
                                <input class="form-control" type="text" name="age" value="{{$user->age}}" id="" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label class="mb-3" for=""><strong>@lang('web.height') (@lang('web.cm'))</strong></label>
                                <input class="form-control" type="text" name="height"  value="{{$user->height}}" id="" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label class="mb-3" for=""><strong> @lang('web.current_weight') (@lang('web.kg'))</strong></label>
                                <input class="form-control" type="text" name="weight" value="{{$user->weight}}" id="" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label class="mb-3" for=""><strong> @lang('web.wantted_weight')  (@lang('web.kg'))</strong></label>
                                <input class="form-control" type="text" name="wanted_weight" value="{{$user->wanted_weight}}" id="" placeholder="">
                            </div>
                            <input class="btn btn-success" type="submit" value="@lang('web.save')">
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="head">
                        <h2> @lang('web.nutritional_factors')</h2>
                    </div>
                    <ul>
                        <li>
                            <div class="d-flex justify-content-between">
                                <span>@lang('web.protein_ratio')</span>
                                <span>572</span>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between">
                                <span>@lang('web.fat_percentage') </span>
                                <span>572</span>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between">
                                <span>@lang('web.Carbohydrate_ratio')</span>
                                <span>20</span>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between">
                                <span>@lang('web.the_number_of_calories_in_the_meal') </span>
                                <span>54</span>
                            </div>
                        </li>
                    </ul>
                    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                    <script>
                        var xValues = ["35%", "25%", "50%"];
                        var yValues = [55, 49, 44];
                        var barColors = [
                            "#ced3c7",
                            "#f47920",
                            "#7aa03f",
                        ];

                        new Chart("myChart", {
                            type: "pie",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                title: {
                                    display: false,
                                }
                            }
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>


@endsection
