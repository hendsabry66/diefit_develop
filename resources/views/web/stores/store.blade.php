@extends('web.layouts.master')
@section('content')
    <div class="store-page">
        <div class="intro" >
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="content">
                            <h1>انقص وزنك في اسبوع فقط</h1>
                            <p>انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع
                                بالنتائج </p>
                            <a href="" class="btn btn-success">انضم معنا</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="category" style="background-color:#FFF">
            <div class="container">
                <div class="head">
                    <h2>@lang('web.List of main store departments')</h2>
                </div>
                <div class="row">
                    @foreach($productCategories as $productCategory)
                        <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="{{url('storeProducts/'.$productCategory->id)}}">
                                <figure>
                                    @if(!empty($productCategory->image))
                                        <img src="{{$productCategory->image}}" alt="">
                                    @else
                                        <img src="{{asset('web/assets/images/c01.png')}}" alt="">
                                    @endif
                                </figure>
                                <h3> {{$productCategory->name}}</h3>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
{{--                <div class="text-center mt-5">--}}
{{--                    <a href="" class="btn btn-warning">المزيد</a>--}}
{{--                </div>--}}
            </div>
        </div>

        <div class="category bg-blue">
            <div class="container">
                <div class="head">
                    <h2>المنتجات الأكثر مبيعاً</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="">
                                <figure><img src="{{asset('web')}}/assets/images/i01.png" alt=""></figure>
                                <h3>عنوان القسم</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="">
                                <figure><img src="{{asset('web')}}/assets/images/i02.png" alt=""></figure>
                                <h3>عنوان القسم</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="">
                                <figure><img src="{{asset('web')}}/assets/images/i03.png" alt=""></figure>
                                <h3>عنوان القسم</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="">
                                <figure><img src="{{asset('web')}}/assets/images/i04.png" alt=""></figure>
                                <h3>عنوان القسم</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="">
                                <figure><img src="{{asset('web')}}/assets/images/i05.png" alt=""></figure>
                                <h3>عنوان القسم</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="">
                                <figure><img src="{{asset('web')}}/assets/images/i06.png" alt=""></figure>
                                <h3>عنوان القسم</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="" class="btn btn-warning">المزيد</a>
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

    </div>

   @endsection
