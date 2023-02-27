@extends('web.layouts.master')
@section('title')
    |
    @lang('web.home')
@endsection
@section('content')
    <div class="intro" style="background-image: url({{asset('/web/assets/images/restaurant_product.jpg')}});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="content">
                        <h1>خلي طعامك صحي</h1>
                        <p>انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع
                            بالنتائج </p>
                        <a href="" class="btn btn-warning">انضم معنا</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="category" style="background-color:#FFF">
        <div class="container">
            <div class="head">
                <h2>@lang('web.categories')</h2>
            </div>
            <div class="row">
                @foreach($foodCategories as $category)
                    <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="{{LaravelLocalization::localizeUrl('restaurant/foods/'.$category->id)}}">
                                <figure>
                                    @if(!empty($category->image))
                                        <img src="{{$category->image}}" alt="">
                                    @else
                                        <figure><img src="{{asset('web')}}/assets/images/i01.png" alt=""></figure>
                                    @endif
                                </figure>
                                <h3> {{$category->name}}</h3>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
{{--            <div class="text-center mt-5">--}}
{{--                <a href="" class="btn btn-warning">المزيد</a>--}}
{{--            </div>--}}
        </div>
    </div>

    <div class="category bg-blue">
        <div class="container">
            <div class="head">
                <h2>@lang('web.bestFoods') </h2>
            </div>
            <div class="row">
                @foreach($bestFoods as $food)
                    <div class="col-md-4 col-6">
                    <div class="item card-sile mb-4" style="position: relative">
                        <a style="margin-bottom: 10px" href="{{url('restaurant/foodDetails/'.$food->id)}}">
                            <figure>
                                @if(!empty($food->image))
                                    <img src="{{$food->image}}" alt="">
                                @else
                                    <img src="{{asset('web/assets/images/i01.png')}}" alt="">
                                @endif
                            </figure>
                            <h3 style="min-height: auto">{{$food->name}}</h3>
                        </a>
                        <div class="content">
                            <div style="margin-bottom: 8px">
                            <div class="desc">
                                {!! str_replace(['<p>','</p>'],'',$food->details) !!}
                            </div>
                            </div>
                            <div class="price text-warning"> {{$food->price}}</div>
                            <a href="" class="btn btn-outline-dark">@lang('web.add to favorite')</a>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>

    <div class="testimonials" style="background-color: #FFF">
        <div class="container">
            <div class="head">
                <h2>آراء العملاء</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="item box-shadow">
                        <div class="d-flex justify-content-between">
                            <div class="tumb">
                                <img src="{{asset('web')}}/assets/images/user01.png" alt="">
                                <span>على القحطاني</span>
                            </div>
                            <div class="stars">
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star off"></i>
                            </div>
                        </div>
                        <div class="content">
                            <div>السلام عليكم ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته
                                مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم
                                ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="item box-shadow">
                        <div class="d-flex justify-content-between">
                            <div class="tumb">
                                <img src="{{asset('web')}}/assets/images/user01.png" alt="">
                                <span>على القحطاني</span>
                            </div>
                            <div class="stars">
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star off"></i>
                            </div>
                        </div>
                        <div class="content">
                            <div>السلام عليكم ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته
                                مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم
                                ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="item box-shadow">
                        <div class="d-flex justify-content-between">
                            <div class="tumb">
                                <img src="{{asset('web')}}/assets/images/user01.png" alt="">
                                <span>على القحطاني</span>
                            </div>
                            <div class="stars">
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star off"></i>
                            </div>
                        </div>
                        <div class="content">
                            <div>السلام عليكم ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته
                                مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم
                                ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="item box-shadow">
                        <div class="d-flex justify-content-between">
                            <div class="tumb">
                                <img src="{{asset('web')}}/assets/images/user01.png" alt="">
                                <span>على القحطاني</span>
                            </div>
                            <div class="stars">
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star on"></i>
                                <i class="fa-solid fa-star off"></i>
                            </div>
                        </div>
                        <div class="content">
                            <div>السلام عليكم ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته
                                مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم
                                ورحمة الله وبركاته مرحبا بكم في موقعنا السلام عليكم ورحمة الله وبركاته</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
