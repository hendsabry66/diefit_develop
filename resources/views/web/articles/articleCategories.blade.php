@extends('web.layouts.master')
@section('title', 'Article Categories')
@section('content')

    <div class="intro article">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="content">
                        <h1>@lang('web.articles')</h1>
                        <p>انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع بالنتائج المزهلة انضم الينا واستمتع
                            بالنتائج </p>
                        <a href="" class="btn btn-success">المزيد</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure>
                        <img src="{{asset('web/assets/images/articles.png')}}" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <div class="category" style="background-color: #FFF">
        <div class="container">
            <div class="head text-center mb-5">
                <h2>@lang('web.articles')</h2>
            </div>
            <div class="row">
                @foreach($articleCategories as $articleCategory)
                <div class="col-md-4 col-6">
                    <a href="{{LaravelLocalization::localizeUrl('/articles/'.$articleCategory->id)}}" class="item text-center">
                        <figure><img src="{{$articleCategory->image}}" alt=""></figure>
                        <h2>{{$articleCategory->name}}</h2>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection
