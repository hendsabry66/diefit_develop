@extends('web.layouts.master')
@section('title', 'Videos')
@section('content')

<div class="intro">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="content">
                    <h1>مرحبا بكم في موقع دايفت</h1>
                    <p>انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع
                        بالنتائج </p>
                    <a href="" class="btn btn-warning">المزيد</a>
                </div>
            </div>
            <div class="col-md-6">
                <figure>
                    <img class="bg-image" src="{{asset('web')}}/assets/images/Shape-423.png" alt="">
                    <img src="{{asset('web')}}/assets/images/img-slider.png" alt="">
                </figure>
            </div>
        </div>
    </div>
</div>


<div class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <figure><img src="{{$about->image}}" alt=""></figure>
            </div>
            <div class="col-md-6">
                <div class="content">
                    <div class="head">
                        <h2> {{$about->title}} </h2>
                    </div>
                    <div>
                        <p>{!! $about->details !!}</p>
{{--                        <div class="swiper-wrapper">--}}
{{--                            <div class="swiper-slide">--}}
{{--                                <div> {{$about->details}}</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="category">
        <div class="container">
            <div class="head">
                <h2> @lang('web.List of main store departments')</h2>
            </div>
            <div class="row">
                @foreach($product_categories as $product_category)
                    <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="{{url('storeProducts/'.$product_category->id)}}">
                                <figure>
                                @if(!empty($product_category->image))
                                    <img src="{{$product_category->image}}" alt="">
                                @else
                                    <img src="{{asset('web/assets/images/c01.png')}}" alt="">
                                @endif
                                </figure>

                            </a>
                            <h3>{{ $product_category->name }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="text-center mt-5">
            <a href="{{url('/store')}}" class="btn btn-warning">@lang('web.more')</a>
        </div>

</div>

<div class="calculator">
    <div class="container">
        <div class="text-center">
            <p><strong>@lang('web.You can use the calculator')</strong></p>
            <a href="" class="btn btn-warning">@lang('web.Go to calculator')</a>
        </div>
    </div>
</div>

<div class="subscriptions">
    <div class="container">
        <div class="head">
            <h2>@lang('web.List of subscriptions')</h2>
        </div>
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach($subscriptions as$subscriptions)
                <div class="swiper-slide">
                    <div class="item">
                        <a href="">
                            <figure><img src="{{asset('web')}}/assets/images/s01.png" alt=""></figure>
                        </a>
                        <div class="caption">
                            <a href="">
                                <h5>{{$subscriptions->name}}</h5>
                            </a>
                            <p class="mb-0">{!! $subscriptions->details !!}  </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>

<div class="category bg-blue">
    <div class="container">
        <div class="head">
            <h2>@lang('web.List of main restaurant departments')</h2>
        </div>
        <div class="row">
            @foreach($food_categories as $food_category)

            <div class="col-md-4 col-6">
                <div class="item card-sile">
                    <a href="">
                        @if(!empty($food_category->image))
                            <figure><img src="{{$food_category->image}}" alt=""></figure>
                        @else
                        <figure><img src="{{asset('web')}}/assets/images/i01.png" alt=""></figure>
                        @endif
                        <h3> {{$food_category->name}}</h3>
                    </a>
                </div>
            </div>
            @endforeach


        </div>
        <div class="text-center mt-5">
            <a href="" class="btn btn-warning">المزيد</a>
        </div>
    </div>
</div>


<div class="blog">
    <div class="container">
        <div class="head">
            <h2>@lang('web.Latest Articles')</h2>
        </div>
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4 col-6">
                <div class="item card-sile">
                    <a href="">
                        <figure><img src="{{$article->image}}" alt=""></figure>
                        <h3>{{$article->title}} </h3>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
        <div class="text-center mt-5">
            <a href="{{url('articleCategories')}}" class="btn btn-warning">@lang('web.more')</a>
        </div>
    </div>
</div>

<div class="directors-word bg-blue">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="content">
                    <div class="head">
                        <h2>{{$centerManger->title}}</h2>
                    </div>
                    <div class="word">
                        <i class="fa-solid fa-quote-right d-block"></i>
                        <p>{!! $centerManger->details !!}</p>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <figure class="mb-0">
                    <img src="{{ $centerManger->image }}" alt="">
                </figure>
            </div>
        </div>
    </div>
</div>

<div class="team">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="content">
                    <div class="head">
                        <h2>فريق العمل</h2>
                    </div>
                    <p class="mb-0">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن
                        التركيز
                        على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها هناك حقيقة مثبتة منذ زمن
                        طويل
                        وهي
                        أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع
                        الفقرات
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row justify-content-center">
                    @foreach($team_members as $member)
                    <div class="col-lg-4 col-6">
                        <div class="item mb-3">
                            <figure><img src="{{$member->image}}" alt=""></figure>
                            <h4>{{$member->name}}</h4>
                        </div>
                    </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="testimonials">
    <div class="container">
        <div class="head">
            <h2>آراء العملاء</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="item">
                    <div class="d-flex justify-content-between">
                        <div class="tumb">
                            <img src="assets/images/user01.png" alt="">
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
                <div class="item">
                    <div class="d-flex justify-content-between">
                        <div class="tumb">
                            <img src="assets/images/user01.png" alt="">
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
                <div class="item">
                    <div class="d-flex justify-content-between">
                        <div class="tumb">
                            <img src="assets/images/user01.png" alt="">
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
                <div class="item">
                    <div class="d-flex justify-content-between">
                        <div class="tumb">
                            <img src="assets/images/user01.png" alt="">
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
